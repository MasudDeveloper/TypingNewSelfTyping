package com.mrdeveloper.myapplication;

public class SmsModel {
    private String method; // bkash, nagad, rocket, upay
    private String trxId;
    private double amount;
    private String senderNumber;
    private String rawSms;
    private long timestamp;
    private boolean isSynced;
    private String syncStatus;

    public SmsModel(String method, String trxId, double amount, String senderNumber, String rawSms, long timestamp, boolean isSynced, String syncStatus) {
        this.method = method;
        this.trxId = trxId;
        this.amount = amount;
        this.senderNumber = senderNumber;
        this.rawSms = rawSms;
        this.timestamp = timestamp;
        this.isSynced = isSynced;
        this.syncStatus = syncStatus;
    }

    public String getMethod() { return method; }
    public String getTrxId() { return trxId; }
    public double getAmount() { return amount; }
    public String getSenderNumber() { return senderNumber; }
    public String getRawSms() { return rawSms; }
    public long getTimestamp() { return timestamp; }
    public boolean isSynced() { return isSynced; }
    public void setSynced(boolean synced) { isSynced = synced; }
    public String getSyncStatus() { return syncStatus; }
    public void setSyncStatus(String syncStatus) { this.syncStatus = syncStatus; }
}
