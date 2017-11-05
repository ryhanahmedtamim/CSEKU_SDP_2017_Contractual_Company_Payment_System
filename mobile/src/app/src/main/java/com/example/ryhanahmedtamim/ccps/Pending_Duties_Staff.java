package com.example.ryhanahmedtamim.ccps;

import android.content.Context;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.TextView;

import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class Pending_Duties_Staff extends AppCompatActivity {

    ListView listView;
    TextView textView;
    ArrayList<String> duties;
    ArrayAdapter arrayAdapter;
    //for all call class it is same
    StringRequest request;
    RequestQueue requestQueue;
    SharedPreferences sharedpreferences;
    private final String MyPREFERENCES = "CCPS_PREFERENCE";
    private final String domainName = "DomainAddress";
    private final String Username = "userName";
    private final String Password = "password";
    private final String ID = "id";
    private final String roleName = "rolename";
    private final String CompanyName ="COMPANY_NAME";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.pending__duties__staff);

        final String dutySting = getIntent().getStringExtra("duties");
        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_PRIVATE);

        textView = (TextView) findViewById(R.id.textViewOfPendingDutiesOfStaff);

        listView = (ListView) findViewById(R.id.pendingDuties);

        textView.setText(sharedpreferences.getString(CompanyName, ""));


        duties = new ArrayList<String>();

        try {
            JSONArray jsonArray = new JSONArray(dutySting);

            for(int i=0; i<jsonArray.length(); i++)
            {
                duties.add("Duty Date  :  "+jsonArray.getJSONObject(i).getString("duty_date"));
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }


        ListAdapter listAdapter = new ArrayAdapter<String>(this,R.layout.support_simple_spinner_dropdown_item,duties);

        listView.setAdapter(listAdapter);


    }
}
