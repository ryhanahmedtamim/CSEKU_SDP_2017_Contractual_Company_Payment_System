package com.example.ryhanahmedtamim.ccps;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class Login extends AppCompatActivity {

    Button loginButton;
    EditText userName;
    EditText password;
    TextView textView;

    String responseString1 = "";
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
        setContentView(R.layout.login);


        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_APPEND);
        final String  mainUrl = sharedpreferences.getString(domainName, "");
        String company = sharedpreferences.getString(CompanyName,"");




        loginButton = (Button) findViewById(R.id.loginButton);
        userName = (EditText) findViewById(R.id.userName);
        password = (EditText) findViewById(R.id.password);
        textView = (TextView) findViewById(R.id.textViewOfLogin);

        if(! sharedpreferences.getString(CompanyName,"").equals(""))
        {
            userName.setText(sharedpreferences.getString(Username,""));
            password.setText(sharedpreferences.getString(Password,""));
        }

        textView.setText(company);
        final String URL = mainUrl+"/?url=mobile/mob_login";

        requestQueue = Volley.newRequestQueue(this);

        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String loginURL = URL;

                String massage = "ERROR";


                request = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {




                        try {
                            JSONObject jsonObject = new JSONObject(response);

                            String user = jsonObject.getString("user");



                            JSONObject jsonObject1 = new JSONObject(user);
                            responseString1 = jsonObject.getString("contracts");

                            //Toast.makeText(getApplicationContext(), jsonObject1.getString("id"), Toast.LENGTH_LONG).show();

                            if (!jsonObject1.toString().equals("\"Error\"") && jsonObject1.getString("rolename") != "admin") {
                                String id = jsonObject1.getString("id");
                                String username = jsonObject1.getString("username");
                                String Savepassword = password.getText().toString();
                                String userRolename = jsonObject1.getString("rolename");
                                SharedPreferences.Editor editor = sharedpreferences.edit();

                                editor.putString(Username, username);
                                editor.putString(Password, Savepassword);
                                editor.putString(ID, id);
                                editor.putString(roleName, userRolename);
                                editor.commit();

                                if (userRolename.equals("staff")) {
                                    if (!responseString1.equals("")) {
                                        //Toast.makeText(getApplicationContext(),responseString,Toast.LENGTH_LONG).show();
                                        Intent intent = new Intent(Login.this,Staff_Home.class);
                                        intent.putExtra("Contracts",responseString1);
                                        startActivity(intent);
                                    }
                                } else {


                                    // Toast.makeText(getApplicationContext(),responseString,Toast.LENGTH_SHORT).show();

                                    if (!responseString1.equals("")) {
                                        Intent intent = new Intent(Login.this, Client_Home.class);
                                        intent.putExtra("Contracts", responseString1);
                                        startActivity(intent);
                                        //finish();
                                    }
                                }

                                // Toast.makeText(getApplicationContext(), sharedpreferences.getString(Username, ""), Toast.LENGTH_LONG).show();


                            } else {

                                Toast.makeText(getApplicationContext(), "Error", Toast.LENGTH_LONG).show();
                            }

                        } catch (JSONException e) {
                            Toast.makeText(getApplicationContext(), "Error", Toast.LENGTH_LONG).show();
                            e.printStackTrace();
                        }

                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();

                    }
                }) {
                    @Override
                    protected Map<String, String> getParams() throws AuthFailureError {
                        HashMap<String, String> hashMap = new HashMap<String, String>();

                        hashMap.put("userName", userName.getText().toString());
                        hashMap.put("password", password.getText().toString());
                        return hashMap;
                    }
                };

                requestQueue.add(request);


            }

        });



    }



}
