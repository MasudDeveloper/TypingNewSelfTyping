package com.mrdeveloper.myapplication;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.telephony.SmsMessage;
import android.util.Log;

public class SmsBroadcastReceiver extends BroadcastReceiver {
    private static final String TAG = "SelfTypingSmsReceiver";
    public static final String ACTION_SMS_PROCESSED = "com.mrdeveloper.myapplication.SMS_PROCESSED";

    @Override
    public void onReceive(Context context, Intent intent) {
        if (!"android.provider.Telephony.SMS_RECEIVED".equals(intent.getAction())) {
            return;
        }

        SharedPreferences prefs = context.getSharedPreferences(ApiSender.PREF_NAME, Context.MODE_PRIVATE);
        boolean isActive = prefs.getBoolean(ApiSender.KEY_IS_ACTIVE, true);
        if (!isActive) {
            Log.d(TAG, "Gateway is currently paused in settings.");
            return;
        }

        Bundle bundle = intent.getExtras();
        if (bundle == null) return;

        try {
            Object[] pdus = (Object[]) bundle.get("pdus");
            String format = bundle.getString("format");
            if (pdus == null || pdus.length == 0) return;

            StringBuilder fullMessage = new StringBuilder();
            String sender = null;
            long timestamp = System.currentTimeMillis();

            for (Object pdu : pdus) {
                SmsMessage sms;
                if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.M) {
                    sms = SmsMessage.createFromPdu((byte[]) pdu, format);
                } else {
                    sms = SmsMessage.createFromPdu((byte[]) pdu);
                }

                if (sms != null) {
                    if (sender == null) sender = sms.getOriginatingAddress();
                    fullMessage.append(sms.getMessageBody());
                    timestamp = sms.getTimestampMillis();
                }
            }

            String body = fullMessage.toString();
            Log.d(TAG, "SMS Received from: " + sender + " | Body: " + body);

            // Parse SMS
            SmsModel model = SmsParser.parse(sender, body, timestamp);
            if (model != null) {
                Log.i(TAG, "Payment detected! Method: " + model.getMethod() + " | TrxID: " + model.getTrxId() + " | Amount: " + model.getAmount());

                // Send to Server
                ApiSender.sendPaymentToServer(context, model, new ApiSender.ApiCallback() {
                    @Override
                    public void onSuccess(String response) {
                        Log.i(TAG, "Successfully synced to SelfTyping Server: " + response);
                        broadcastUpdate(context, model, true, "Synced successfully");
                    }

                    @Override
                    public void onError(String error) {
                        Log.e(TAG, "Failed to sync to SelfTyping Server: " + error);
                        broadcastUpdate(context, model, false, error);
                    }
                });
            }

        } catch (Exception e) {
            Log.e(TAG, "Error processing incoming SMS", e);
        }
    }

    private void broadcastUpdate(Context context, SmsModel model, boolean success, String message) {
        Intent updateIntent = new Intent(ACTION_SMS_PROCESSED);
        updateIntent.putExtra("method", model.getMethod());
        updateIntent.putExtra("trx_id", model.getTrxId());
        updateIntent.putExtra("amount", model.getAmount());
        updateIntent.putExtra("sender", model.getSenderNumber());
        updateIntent.putExtra("success", success);
        updateIntent.putExtra("status", message);
        context.sendBroadcast(updateIntent);
    }
}
