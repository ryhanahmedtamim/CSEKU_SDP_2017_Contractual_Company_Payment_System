package com.example.ryhanahmedtamim.ccps;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.BaseAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class Pending_Duties_Of_Client extends AppCompatActivity {

    TextView textView;
    ListView listView;
    BaseAdapter baseAdapter;
    ArrayList<String> duty;

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
        setContentView(R.layout.pending__duties__of__client);

        textView = (TextView) findViewById(R.id.textViewOfPendingDutiesOfClient);
        listView = (ListView) findViewById(R.id.pendingDutiesListView);

        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_PRIVATE);
        textView.setText(sharedpreferences.getString(CompanyName, ""));
        sequestQueue = Volley.newRequestQueue(this);


       final  String duties = getIntent().getStringExtra("duties");
        final String  mainUrl = sharedpreferences.getString(domainName, "");
        duty = new ArrayList<String>();
        JSONArray jsonArray = null;

        try {
            jsonArray = new JSONArray(duties);

            for(int i=0; i<jsonArray.length(); i++)
            {
                duty.add("Duty Date  :  "+ jsonArray.getJSONObject(i).getString("duty_date"));
            }


        } catch (JSONException e) {
            e.printStackTrace();
        }


        baseAdapter = new BaseAdapter() {
            LayoutInflater layoutInflater = (LayoutInflater) getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            @Override
            public int getCount() {
                return duty.size();
            }

            @Override
            public Object getItem(int position) {
                return duty.get(position);
            }

            @Override
            public long getItemId(int position) {
                return 0;
            }

            @Override
            public View getView(int position, View view, ViewGroup parent) {

                if(view == null)
                {
                    view = layoutInflater.inflate(R.layout.duty_layout,null);
                }

                TextView dutyDate = (TextView) view.findViewById(R.id.dutyDate);

                dutyDate.setText(duty.get(position));



                return view;
            }
        };

        listView.setAdapter(baseAdapter);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, final int position, long id) {
                //
                JSONArray jsonArray1 = null;
                String dutyId = "";
                try {
                    jsonArray1 = new JSONArray(duties);
                    dutyId = jsonArray1.getJSONObject(position).getString("id");
                } catch (JSONException e) {
                    e.printStackTrace();
                }


                final String URL = mainUrl+"/?url=mobile/approveDuty/"+ dutyId;
                stringRequest = new StringRequest(Request.Method.GET, URL, new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        JSONObject jsonObject;

                        try {
                            jsonObject = new JSONObject(response);

                            String result = jsonObject.getString("result");

                            if(result == "true")
                            {
                                duty.remove(position);
                                baseAdapter.notifyDataSetChanged();
                                Toast.makeText(getApplicationContext(),"Duty is approved",Toast.LENGTH_LONG).show();
                            }
                            else {
                                Toast.makeText(getApplicationContext(),"Error",Toast.LENGTH_LONG).show();
                            }




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
