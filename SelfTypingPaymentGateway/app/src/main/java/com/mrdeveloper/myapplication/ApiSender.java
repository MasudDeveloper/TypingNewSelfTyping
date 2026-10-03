package com.mrdeveloper.myapplication;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;

import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class ApiSender {
    private static final String TAG = "SelfTypingApiSender";
    public static final String PREF_NAME = "SelfTypingGatewayPrefs";
    public static final String KEY_SERVER_URL = "server_url";
    public static final String KEY_API_KEY = "api_key";
    public static final String KEY_IS_ACTIVE = "is_active";

    public static final String DEFAULT_SERVER_URL = "https://selftyping.com/api/v1/sms/webhook";
    public static final String DEFAULT_API_KEY = "selftyping_gateway_secret_2026";

    private static final ExecutorService executor = Executors.newSingleThreadExecutor();
    private static final Handler mainHandler = new Handler(Looper.getMainLooper());

    public interface ApiCallback {
        void onSuccess(String response);
        void onError(String error);
    }

    public static void sendPaymentToServer(Context context, SmsModel model, ApiCallback callback) {
        SharedPreferences prefs = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        String serverUrl = prefs.getString(KEY_SERVER_URL, DEFAULT_SERVER_URL);
        String apiKey = prefs.getString(KEY_API_KEY, DEFAULT_API_KEY);

        executor.execute(() -> {
            HttpURLConnection conn = null;
            try {
                URL url = new URL(serverUrl);
                conn = (HttpURLConnection) url.openConnection();
                conn.setRequestMethod("POST");
                conn.setRequestProperty("Content-Type", "application/json; charset=UTF-8");
                conn.setRequestProperty("Accept", "application/json");
                conn.setRequestProperty("X-API-KEY", apiKey);
                conn.setConnectTimeout(15000);
                conn.setReadTimeout(15000);
                conn.setDoOutput(true);
                conn.setDoInput(true);

                JSONObject jsonPayload = new JSONObject();
                jsonPayload.put("trx_id", model.getTrxId());
                jsonPayload.put("amount", model.getAmount());
                jsonPayload.put("method", model.getMethod());
                jsonPayload.put("sender_number", model.getSenderNumber());
                jsonPayload.put("raw_sms", model.getRawSms());
                jsonPayload.put("api_key", apiKey);

                byte[] postData = jsonPayload.toString().getBytes("UTF-8");
                OutputStream os = conn.getOutputStream();
                os.write(postData);
                os.flush();
                os.close();

                int responseCode = conn.getResponseCode();
                BufferedReader br;
                if (responseCode >= 200 && responseCode < 300) {
                    br = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                } else {
                    br = new BufferedReader(new InputStreamReader(conn.getErrorStream()));
                }

                StringBuilder response = new StringBuilder();
                String line;
                while ((line = br.readLine()) != null) {
                    response.append(line);
                }
                br.close();

                final String result = response.toString();
                if (responseCode == 200 || responseCode == 201) {
                    model.setSynced(true);
                    model.setSyncStatus("Synced");
                    mainHandler.post(() -> {
                        if (callback != null) callback.onSuccess(result);
                    });
                } else {
                    model.setSynced(false);
                    model.setSyncStatus("Failed (Code " + responseCode + ")");
                    mainHandler.post(() -> {
                        if (callback != null) callback.onError("HTTP " + responseCode + ": " + result);
                    });
                }

            } catch (Exception e) {
                Log.e(TAG, "Error sending SMS to server", e);
                model.setSynced(false);
                model.setSyncStatus("Network Error: " + e.getMessage());
                mainHandler.post(() -> {
                    if (callback != null) callback.onError(e.getMessage());
                });
            } finally {
                if (conn != null) {
                    conn.disconnect();
                }
            }
        });
    }
}
