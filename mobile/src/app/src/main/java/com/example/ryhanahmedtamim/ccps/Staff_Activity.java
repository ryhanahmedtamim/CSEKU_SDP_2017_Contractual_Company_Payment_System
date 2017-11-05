package com.example.ryhanahmedtamim.ccps;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class Staff_Activity extends AppCompatActivity {

    Button submitduty,pendingDuty;
    TextView textView;

    StringRequest request;
    RequestQueue requestQueue;

    StringRequest stringRequest;
    RequestQueue sequestQueue;
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
        setContentView(R.layout.staff_activity);

        final String contracSting = getIntent().getStringExtra("Contract");
        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_PRIVATE);

        submitduty = (Button) findViewById(R.id.submitDuty);
        pendingDuty = (Button) findViewById(R.id.pendingDutyOfStaff);
        textView = (TextView) findViewById(R.id.textViewStaffActivity);

        textView.setText(sharedpreferences.getString(CompanyName, ""));

        final String  mainUrl = sharedpreferences.getString(domainName, "");

        JSONObject jsonObject = null;

        String contractId = null;

        try {
            jsonObject = new JSONObject(contracSting);

            contractId = jsonObject.getString("id");
        } catch (JSONException e) {
            e.printStackTrace();
        }


        final String URL = mainUrl+"/?url=mobile/get_pending_duties/"+contractId;

        sequestQueue = Volley.newRequestQueue(this);


        submitduty.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent intent = new Intent(Staff_Activity.this,Submit_Duty.class);

                intent.putExtra("Contract", contracSting);
                startActivity(intent);
               // Toast.makeText(getApplicationContext(), contracSting, Toast.LENGTH_LONG).show();
            }
        });




        pendingDuty.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                stringRequest = new StringRequest(Request.Method.GET, URL, new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        JSONObject jsonObject;

                        try {
                            jsonObject = new JSONObject(response);

                            String pendingDuties = jsonObject.getString("result");

                            Intent intent = new Intent(Staff_Activity.this,Pending_Duties_Staff.class);
                            intent.putExtra("duties",pendingDuties);
                            startActivity(intent);


                        } catch (JSONException e) {
                            e.printStackTrace();
                        }


                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                    }
                });
                sequestQueue.add(stringRequest);

            }
        });


    }
}
