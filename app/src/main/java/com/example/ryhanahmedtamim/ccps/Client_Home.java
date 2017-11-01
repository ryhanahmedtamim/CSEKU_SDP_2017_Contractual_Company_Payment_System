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
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import org.json.JSONArray;
import org.json.JSONException;
import java.util.ArrayList;

public class Client_Home extends AppCompatActivity {

    TextView textView;

    ListView listView;
    ArrayList<Contract> contracts;
    BaseAdapter baseAdapter;

    SharedPreferences sharedpreferences;
    private final String MyPREFERENCES = "CCPS_PREFERENCE";
    private final String domainName = "DomainAddress";
    private final String Username = "userName";
    private final String Password = "password";
    private final String ID = "id";
    private final String roleName = "rolename";
    private final String CompanyName ="COMPANY_NAME";




    StringRequest stringRequest;
    RequestQueue sequestQueue;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.client__home);

        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_PRIVATE);



        listView =(ListView) findViewById(R.id.contracOfClient);
        textView =(TextView) findViewById(R.id.textViewOfClientHome);
        contracts = new ArrayList<Contract>();


        final String contracString = getIntent().getStringExtra("Contracts");


        String  titleOfContract,clientName,staffName,phoneNumber;
        Contract contract;

        JSONArray jsonArray = null;


        textView.setText(sharedpreferences.getString(CompanyName, ""));

        try{
            jsonArray = new JSONArray(contracString);

            for (int i=0; i<jsonArray.length(); i++)
            {

                titleOfContract = jsonArray.getJSONObject(i).getString("contrac_titile");
                staffName = ",  Staff Name  :  " +jsonArray.getJSONObject(i).getString("staff_name");
                clientName = "";
                phoneNumber = "Phone No.  :  "+jsonArray.getJSONObject(i).getString("contact_no");


                contract = new Contract(titleOfContract,clientName,staffName,phoneNumber);

                contracts.add(contract);

            }
        }
        catch (Exception e)
        {
            Toast.makeText(getApplicationContext(),"Error",Toast.LENGTH_LONG).show();
        }

        baseAdapter = new BaseAdapter() {
            LayoutInflater layoutInflater = (LayoutInflater) getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            @Override
            public int getCount() {
                return contracts.size();
            }

            @Override
            public Object getItem(int position) {
                return contracts.get(position);
            }

            @Override
            public long getItemId(int position) {
                return 0;
            }

            @Override
            public View getView(int position, View view, ViewGroup parent) {

                if(view == null)
                {
                    view = layoutInflater.inflate(R.layout.contract_layout,null);
                }

                TextView title,name,phone;

                title = (TextView) view.findViewById(R.id.contractName);
                name = (TextView) view.findViewById(R.id.staffOrClientName);
                phone = (TextView) view.findViewById(R.id.phoneNumber);

                title.setText(contracts.get(position).getTitleOfContract());
                name.setText(contracts.get(position).getStaffName());
                phone.setText(contracts.get(position).getPhoneNumber());

                return view;
            }
        };

        listView.setAdapter(baseAdapter);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                JSONArray jsonArray1 = null;
                try {
                    jsonArray1 = new JSONArray(contracString);
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                String _contractString = "";

                try {
                    _contractString = jsonArray1.getJSONObject(position).toString();
                } catch (JSONException e) {
                    e.printStackTrace();
                }

               // Toast.makeText(getApplicationContext(),_contractString,Toast.LENGTH_LONG).show();

                Intent intent = new Intent(Client_Home.this,Client_Activity.class);

                intent.putExtra("Contract",_contractString);

                startActivity(intent);


            }
        });
    }
}
