package com.mrdeveloper.myapplication;

import android.util.Log;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class SmsParser {
    private static final String TAG = "SelfTypingParser";

    public static SmsModel parse(String sender, String messageBody, long timestamp) {
        if (messageBody == null || messageBody.trim().isEmpty()) {
            return null;
        }

        String lowerSender = sender != null ? sender.toLowerCase() : "";
        String body = messageBody.trim();

        // 1. bKash Detection
        if (lowerSender.contains("bkash") || lowerSender.contains("16247") || body.toLowerCase().contains("bkash") || body.contains("TrxID")) {
            SmsModel model = parseBkash(sender, body, timestamp);
            if (model != null) return model;
        }

        // 2. Nagad Detection
        if (lowerSender.contains("nagad") || lowerSender.contains("16167") || body.toLowerCase().contains("nagad") || body.contains("TxnID")) {
            SmsModel model = parseNagad(sender, body, timestamp);
            if (model != null) return model;
        }

        // 3. Rocket Detection
        if (lowerSender.contains("16216") || lowerSender.contains("rocket") || lowerSender.contains("dbbl") || body.toLowerCase().contains("rocket")) {
            SmsModel model = parseRocket(sender, body, timestamp);
            if (model != null) return model;
        }

        // 4. Upay Detection
        if (lowerSender.contains("upay") || lowerSender.contains("ucb") || body.toLowerCase().contains("upay")) {
            SmsModel model = parseUpay(sender, body, timestamp);
            if (model != null) return model;
        }

        // Generic fallback parser for TrxID and Amount
        return parseGeneric(sender, body, timestamp);
    }

    private static SmsModel parseBkash(String sender, String body, long timestamp) {
        try {
            // Find TrxID: TrxID 9K28X9LA or TrxID: 9K28X9LA
            Pattern trxPattern = Pattern.compile("TrxID[:\\s]+([A-Za-z0-9]+)", Pattern.CASE_INSENSITIVE);
            Matcher trxMatcher = trxPattern.matcher(body);
            if (!trxMatcher.find()) return null;
            String trxId = trxMatcher.group(1).trim().toUpperCase();

            // Find Amount: Tk 200.00 or Tk. 200.00
            double amount = extractAmount(body);
            if (amount <= 0) return null;

            // Find Sender Number: from 017xxxxxxxx
            String senderNum = extractPhoneNumber(body);

            return new SmsModel("bkash", trxId, amount, senderNum, body, timestamp, false, "Pending");
        } catch (Exception e) {
            Log.e(TAG, "Error parsing bKash SMS", e);
            return null;
        }
    }

    private static SmsModel parseNagad(String sender, String body, long timestamp) {
        try {
            // Find TxnID: TxnID: 72KB9X1 or TxnID 72KB9X1
            Pattern trxPattern = Pattern.compile("(?:TxnID|TxnId|Txn ID|TrxID)[:\\s]+([A-Za-z0-9]+)", Pattern.CASE_INSENSITIVE);
            Matcher trxMatcher = trxPattern.matcher(body);
            if (!trxMatcher.find()) return null;
            String trxId = trxMatcher.group(1).trim().toUpperCase();

            double amount = extractAmount(body);
            if (amount <= 0) return null;

            String senderNum = extractPhoneNumber(body);

            return new SmsModel("nagad", trxId, amount, senderNum, body, timestamp, false, "Pending");
        } catch (Exception e) {
            Log.e(TAG, "Error parsing Nagad SMS", e);
            return null;
        }
    }

    private static SmsModel parseRocket(String sender, String body, long timestamp) {
        try {
            Pattern trxPattern = Pattern.compile("(?:Txn|TrxID|TxnID)[:\\s]+([A-Za-z0-9]+)", Pattern.CASE_INSENSITIVE);
            Matcher trxMatcher = trxPattern.matcher(body);
            if (!trxMatcher.find()) return null;
            String trxId = trxMatcher.group(1).trim().toUpperCase();

            double amount = extractAmount(body);
            if (amount <= 0) return null;

            String senderNum = extractPhoneNumber(body);

            return new SmsModel("rocket", trxId, amount, senderNum, body, timestamp, false, "Pending");
        } catch (Exception e) {
            Log.e(TAG, "Error parsing Rocket SMS", e);
            return null;
        }
    }

    private static SmsModel parseUpay(String sender, String body, long timestamp) {
        try {
            Pattern trxPattern = Pattern.compile("(?:TxnID|TrxID|Txn)[:\\s]+([A-Za-z0-9]+)", Pattern.CASE_INSENSITIVE);
            Matcher trxMatcher = trxPattern.matcher(body);
            if (!trxMatcher.find()) return null;
            String trxId = trxMatcher.group(1).trim().toUpperCase();

            double amount = extractAmount(body);
            if (amount <= 0) return null;

            String senderNum = extractPhoneNumber(body);

            return new SmsModel("upay", trxId, amount, senderNum, body, timestamp, false, "Pending");
        } catch (Exception e) {
            Log.e(TAG, "Error parsing Upay SMS", e);
            return null;
        }
    }

    private static SmsModel parseGeneric(String sender, String body, long timestamp) {
        try {
            Pattern trxPattern = Pattern.compile("(?:TrxID|TxnID|Transaction ID|Ref)[:\\s]+([A-Za-z0-9]{6,})", Pattern.CASE_INSENSITIVE);
            Matcher trxMatcher = trxPattern.matcher(body);
            if (!trxMatcher.find()) return null;
            String trxId = trxMatcher.group(1).trim().toUpperCase();

            double amount = extractAmount(body);
            if (amount <= 0) return null;

            String senderNum = extractPhoneNumber(body);
            return new SmsModel("mobile_banking", trxId, amount, senderNum, body, timestamp, false, "Pending");
        } catch (Exception e) {
            return null;
        }
    }

    private static double extractAmount(String body) {
        Pattern amountPattern = Pattern.compile("(?:Tk|TK|BDT|Amount|Tk\\.)[:\\s]*([0-9]+(?:,[0-9]+)*(?:\\.[0-9]{1,2})?)", Pattern.CASE_INSENSITIVE);
        Matcher matcher = amountPattern.matcher(body);
        if (matcher.find()) {
            String amtStr = matcher.group(1).replace(",", "");
            return Double.parseDouble(amtStr);
        }
        return 0.0;
    }

    private static String extractPhoneNumber(String body) {
        Pattern phonePattern = Pattern.compile("(?:from|From|sender|Sender)[:\\s]*(01[3-9][0-9]{8})");
        Matcher matcher = phonePattern.matcher(body);
        if (matcher.find()) {
            return matcher.group(1);
        }
        return "Unknown";
    }
}
