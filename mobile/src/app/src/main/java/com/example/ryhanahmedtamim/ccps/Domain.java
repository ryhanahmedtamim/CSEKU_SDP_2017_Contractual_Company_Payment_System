package com.example.ryhanahmedtamim.ccps;


import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class Domain extends AppCompatActivity {

    private Button domainSubmitButton;
    private EditText domainEditText;
    private String domainName = "";
    SharedPreferences sharedpreferences;
    private   final String MyPREFERENCES = "CCPS_PREFERENCE";
    private   final String Name = "DomainAddress";
    private final String CompanyName ="COMPANY_NAME";

    StringRequest stringRequest;
    RequestQueue sequestQueue;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.domain);

        domainSubmitButton = (Button) findViewById(R.id.domainSubmitButton);
        domainEditText =(EditText) findViewById(R.id.domainEditText);


        sequestQueue = Volley.newRequestQueue(this);

        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_PRIVATE);
        if(sharedpreferences.getString(Name, "")!="")
        {
            Intent intent = new Intent(Domain.this,Login.class);
            startActivity(intent);
            finish();
        }


        domainSubmitButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                domainName = "http://" + domainEditText.getText().toString();


                final String myUrl = domainName + "/?url=home/mobile";

                stringRequest = new StringRequest(Request.Method.GET, myUrl, new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        JSONObject jsonObject;

                        try {
                            jsonObject = new JSONObject(response);

                            String company = jsonObject.getString("company_name");

                            SharedPreferences.Editor editor = sharedpreferences.edit();
                            editor.putString(Name, domainName);
                            editor.putString(CompanyName, company);

                            editor.commit();
                            Intent intent = new Intent(Domain.this,Login.class);
                            startActivity(intent);
                            finish();

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
