package com.mrdeveloper.myapplication;

import android.Manifest;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.os.Build;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import com.google.android.material.card.MaterialCardView;
import com.google.android.material.switchmaterial.SwitchMaterial;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class MainActivity extends AppCompatActivity {
    private static final int PERMISSION_REQUEST_CODE = 101;

    private TextView tvStatusDot, tvStatusText, tvTotalSynced, tvLastActivity, tvEmptyState;
    private SwitchMaterial switchGateway;
    private EditText etServerUrl, etApiKey;
    private Button btnSaveConfig, btnTestWebhook;
    private LinearLayout layoutTransactionsList;

    private SharedPreferences prefs;
    private int totalSyncedCount = 0;

    private final BroadcastReceiver smsUpdateReceiver = new BroadcastReceiver() {
        @Override
        public void onReceive(Context context, Intent intent) {
            String method = intent.getStringExtra("method");
            String trxId = intent.getStringExtra("trx_id");
            double amount = intent.getDoubleExtra("amount", 0);
            String sender = intent.getStringExtra("sender");
            boolean success = intent.getBooleanExtra("success", false);
            String status = intent.getStringExtra("status");

            addTransactionCard(method, trxId, amount, sender, success, status);
        }
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        prefs = getSharedPreferences(ApiSender.PREF_NAME, MODE_PRIVATE);

        // Bind UI
        tvStatusDot = findViewById(R.id.tvStatusDot);
        tvStatusText = findViewById(R.id.tvStatusText);
        tvTotalSynced = findViewById(R.id.tvTotalSynced);
        tvLastActivity = findViewById(R.id.tvLastActivity);
        tvEmptyState = findViewById(R.id.tvEmptyState);
        switchGateway = findViewById(R.id.switchGateway);
        etServerUrl = findViewById(R.id.etServerUrl);
        etApiKey = findViewById(R.id.etApiKey);
        btnSaveConfig = findViewById(R.id.btnSaveConfig);
        btnTestWebhook = findViewById(R.id.btnTestWebhook);
        layoutTransactionsList = findViewById(R.id.layoutTransactionsList);

        // Load saved settings
        etServerUrl.setText(prefs.getString(ApiSender.KEY_SERVER_URL, ApiSender.DEFAULT_SERVER_URL));
        etApiKey.setText(prefs.getString(ApiSender.KEY_API_KEY, ApiSender.DEFAULT_API_KEY));
        boolean isActive = prefs.getBoolean(ApiSender.KEY_IS_ACTIVE, true);
        switchGateway.setChecked(isActive);
        updateGatewayStatusUI(isActive);

        // Listeners
        btnSaveConfig.setOnClickListener(v -> saveSettings());
        btnTestWebhook.setOnClickListener(v -> sendTestWebhook());

        switchGateway.setOnCheckedChangeListener((buttonView, isChecked) -> {
            prefs.edit().putBoolean(ApiSender.KEY_IS_ACTIVE, isChecked).apply();
            updateGatewayStatusUI(isChecked);
            if (isChecked) {
                startGatewayService();
            } else {
                stopGatewayService();
            }
        });

        // Request Permissions
        checkAndRequestPermissions();

        // Start Foreground Service
        if (isActive) {
            startGatewayService();
        }
    }

    @Override
    protected void onResume() {
        super.onResume();
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            registerReceiver(smsUpdateReceiver, new IntentFilter(SmsBroadcastReceiver.ACTION_SMS_PROCESSED), Context.RECEIVER_NOT_EXPORTED);
        } else {
            registerReceiver(smsUpdateReceiver, new IntentFilter(SmsBroadcastReceiver.ACTION_SMS_PROCESSED));
        }
    }

    @Override
    protected void onPause() {
        super.onPause();
        try {
            unregisterReceiver(smsUpdateReceiver);
        } catch (Exception ignored) {}
    }

    private void updateGatewayStatusUI(boolean isActive) {
        if (isActive) {
            tvStatusDot.setBackgroundColor(Color.parseColor("#10B981"));
            tvStatusText.setText("Gateway Status: Running");
            tvStatusText.setTextColor(Color.parseColor("#FFFFFF"));
        } else {
            tvStatusDot.setBackgroundColor(Color.parseColor("#EF4444"));
            tvStatusText.setText("Gateway Status: Paused");
            tvStatusText.setTextColor(Color.parseColor("#94A3B8"));
        }
    }

    private void saveSettings() {
        String url = etServerUrl.getText().toString().trim();
        String apiKey = etApiKey.getText().toString().trim();

        if (url.isEmpty()) {
            Toast.makeText(this, "Please enter valid Server Webhook URL", Toast.LENGTH_SHORT).show();
            return;
        }

        prefs.edit()
                .putString(ApiSender.KEY_SERVER_URL, url)
                .putString(ApiSender.KEY_API_KEY, apiKey)
                .apply();

        Toast.makeText(this, "Settings Saved Successfully!", Toast.LENGTH_SHORT).show();
    }

    private void sendTestWebhook() {
        saveSettings();
        String testTrxId = "TEST" + (System.currentTimeMillis() % 1000000);
        SmsModel testModel = new SmsModel(
                "bkash",
                testTrxId,
                100.0,
                "01700000000",
                "You have received Tk 100.00 from 01700000000. TrxID " + testTrxId,
                System.currentTimeMillis(),
                false,
                "Testing..."
        );

        Toast.makeText(this, "Sending Test Webhook...", Toast.LENGTH_SHORT).show();

        ApiSender.sendPaymentToServer(this, testModel, new ApiSender.ApiCallback() {
            @Override
            public void onSuccess(String response) {
                Toast.makeText(MainActivity.this, "Server Connected! " + response, Toast.LENGTH_LONG).show();
                addTransactionCard("bkash", testTrxId, 100.0, "01700000000", true, "Test Synced");
            }

            @Override
            public void onError(String error) {
                Toast.makeText(MainActivity.this, "Connection Error: " + error, Toast.LENGTH_LONG).show();
                addTransactionCard("bkash", testTrxId, 100.0, "01700000000", false, error);
            }
        });
    }

    private void addTransactionCard(String method, String trxId, double amount, String sender, boolean success, String status) {
        tvEmptyState.setVisibility(View.GONE);

        totalSyncedCount++;
        tvTotalSynced.setText(String.valueOf(totalSyncedCount));
        SimpleDateFormat sdf = new SimpleDateFormat("hh:mm:ss a", Locale.getDefault());
        tvLastActivity.setText(sdf.format(new Date()));

        MaterialCardView card = new MaterialCardView(this);
        LinearLayout.LayoutParams params = new LinearLayout.LayoutParams(
                LinearLayout.LayoutParams.MATCH_PARENT, LinearLayout.LayoutParams.WRAP_CONTENT
        );
        params.setMargins(0, 0, 0, 20);
        card.setLayoutParams(params);
        card.setCardBackgroundColor(Color.parseColor("#1E293B"));
        card.setRadius(24f);
        card.setStrokeColor(Color.parseColor(success ? "#059669" : "#DC2626"));
        card.setStrokeWidth(2);

        LinearLayout inner = new LinearLayout(this);
        inner.setOrientation(LinearLayout.VERTICAL);
        inner.setPadding(30, 25, 30, 25);

        // Row 1: Method & Amount
        LinearLayout row1 = new LinearLayout(this);
        row1.setOrientation(LinearLayout.HORIZONTAL);

        TextView tvMethod = new TextView(this);
        tvMethod.setText(method != null ? method.toUpperCase() : "PAYMENT");
        tvMethod.setTextColor(Color.parseColor("#38BDF8"));
        tvMethod.setTextSize(14f);
        tvMethod.setTypeface(null, android.graphics.Typeface.BOLD);
        tvMethod.setLayoutParams(new LinearLayout.LayoutParams(0, LinearLayout.LayoutParams.WRAP_CONTENT, 1f));

        TextView tvAmount = new TextView(this);
        tvAmount.setText(amount + " ৳");
        tvAmount.setTextColor(Color.parseColor("#10B981"));
        tvAmount.setTextSize(16f);
        tvAmount.setTypeface(null, android.graphics.Typeface.BOLD);

        row1.addView(tvMethod);
        row1.addView(tvAmount);

        // Row 2: TrxID & Status
        TextView tvTrx = new TextView(this);
        tvTrx.setText("TrxID: " + trxId + " • From: " + sender);
        tvTrx.setTextColor(Color.parseColor("#E2E8F0"));
        tvTrx.setTextSize(12f);
        tvTrx.setPadding(0, 6, 0, 4);

        TextView tvStatus = new TextView(this);
        tvStatus.setText("Status: " + status);
        tvStatus.setTextColor(Color.parseColor(success ? "#34D399" : "#F87171"));
        tvStatus.setTextSize(11f);

        inner.addView(row1);
        inner.addView(tvTrx);
        inner.addView(tvStatus);

        card.addView(inner);
        layoutTransactionsList.addView(card, 0);
    }

    private void startGatewayService() {
        Intent serviceIntent = new Intent(this, GatewayForegroundService.class);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            startForegroundService(serviceIntent);
        } else {
            startService(serviceIntent);
        }
    }

    private void stopGatewayService() {
        Intent serviceIntent = new Intent(this, GatewayForegroundService.class);
        stopService(serviceIntent);
    }

    private void checkAndRequestPermissions() {
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.RECEIVE_SMS) != PackageManager.PERMISSION_GRANTED ||
                ContextCompat.checkSelfPermission(this, Manifest.permission.READ_SMS) != PackageManager.PERMISSION_GRANTED) {

            ActivityCompat.requestPermissions(this,
                    new String[]{
                            Manifest.permission.RECEIVE_SMS,
                            Manifest.permission.READ_SMS
                    },
                    PERMISSION_REQUEST_CODE);
        }

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            if (ContextCompat.checkSelfPermission(this, Manifest.permission.POST_NOTIFICATIONS) != PackageManager.PERMISSION_GRANTED) {
                ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.POST_NOTIFICATIONS}, 102);
            }
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == PERMISSION_REQUEST_CODE) {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                Toast.makeText(this, "SMS Permissions Granted! Gateway Ready.", Toast.LENGTH_SHORT).show();
            } else {
                Toast.makeText(this, "SMS Permission is required to intercept bKash/Nagad payments.", Toast.LENGTH_LONG).show();
            }
        }
    }
}