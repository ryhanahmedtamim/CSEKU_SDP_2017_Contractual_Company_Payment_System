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
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class Staff_Home extends AppCompatActivity {

    TextView textView;
    ListView listView;
    ArrayList<Contract> contracts;
    BaseAdapter baseAdapter;


    //for all call class it is same
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
        setContentView(R.layout.staff__home);

        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_PRIVATE);
        listView = (ListView) findViewById(R.id.contractOfStaffHome);
        textView = (TextView) findViewById(R.id.StaffHome);
        contracts = new ArrayList<Contract>();

        textView.setText(sharedpreferences.getString(CompanyName, ""));

        final String contracString = getIntent().getStringExtra("Contracts");

        // Toast.makeText(getApplicationContext(),contracString,Toast.LENGTH_LONG).show();

        JSONArray jsonArray = null;

        String  titleOfContract,clientName,staffName,phoneNumber;
        Contract contract;


        try{
            jsonArray = new JSONArray(contracString);

            for (int i=0; i<jsonArray.length(); i++)
            {

                titleOfContract = jsonArray.getJSONObject(i).getString("contrac_titile");
                clientName = ",  Client Name  :  " +jsonArray.getJSONObject(i).getString("client_name");
                staffName = "";
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
                name.setText(contracts.get(position).getClientName());
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

                JSONObject jsonObject;


                try {
                    _contractString =  jsonArray1.getJSONObject(position).toString();
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                Intent intent = new Intent(Staff_Home.this,Staff_Activity.class);

                intent.putExtra("Contract",_contractString);

                startActivity(intent);

                //Toast.makeText(getApplicationContext(),_contractString,Toast.LENGTH_LONG).show();


            }
        });



    }
}
