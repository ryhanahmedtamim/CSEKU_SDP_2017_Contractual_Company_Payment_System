package com.example.ryhanahmedtamim.ccps;


import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import java.util.HashMap;
import java.util.Map;

import android.widget.TextView;
import android.widget.Toast;
import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import org.json.JSONException;
import org.json.JSONObject;

public class LoginActivity extends AppCompatActivity {

    Button loginButton;
    EditText userName;
    EditText password;
    TextView textView;
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
        setContentView(R.layout.activity_login);

        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_APPEND);
        String  mainUrl = sharedpreferences.getString(domainName, "");
        String company = sharedpreferences.getString(CompanyName,"");


        loginButton = (Button) findViewById(R.id.loginButton);
        userName = (EditText) findViewById(R.id.userName);
        password = (EditText) findViewById(R.id.password);
        textView = (TextView) findViewById(R.id.textViewOfLogin);

        textView.setText(company);
        final String URL = mainUrl+"/?url=login/mob_login";

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
                            if (!jsonObject.toString().equals("\"Error\"") && jsonObject.getString("rolename") !="admin")
                            {
                                String id = jsonObject.getString("id");
                                String username = jsonObject.getString("username");
                                String Savepassword = password.getText().toString();
                                String userRolename = jsonObject.getString("rolename");
                                SharedPreferences.Editor editor = sharedpreferences.edit();

                                editor.putString(Username, username);
                                editor.putString(Password, Savepassword);
                                editor.putString(ID, id);
                                editor.putString(roleName,userRolename);
                                editor.commit();

                                Toast.makeText(getApplicationContext(),sharedpreferences.getString(Username, ""),Toast.LENGTH_LONG).show();


                            }
                            else
                            {

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
                        HashMap<String , String> hashMap = new HashMap<String, String>();

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
