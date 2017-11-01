package com.example.ryhanahmedtamim.ccps;

/**
 * Created by Ryhan Ahmed Tamim on 10/14/2017.
 */
public class Contract
{
    String  titleOfContract,clientName,staffName,phoneNumber;

    public Contract(String titleOfContract, String clientName, String staffName, String phoneNumber) {
        this.titleOfContract = titleOfContract;
        this.clientName = clientName;
        this.staffName = staffName;
        this.phoneNumber = phoneNumber;
    }

    public String getTitleOfContract() {
        return titleOfContract;
    }

    public String getClientName() {
        return clientName;
    }

    public String getStaffName() {
        return staffName;
    }

    public String getPhoneNumber() {
        return phoneNumber;
    }
}
