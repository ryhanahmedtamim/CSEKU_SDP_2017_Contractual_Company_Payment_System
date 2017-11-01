package com.example.ryhanahmedtamim.ccps;

import android.Manifest;
import android.annotation.TargetApi;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Build;
import android.os.CountDownTimer;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.MotionEvent;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
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

import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Map;

public class Submit_Duty extends AppCompatActivity {

    TextView textView, duty_time;
    EditText nextDate;
    Button dutySubmitButton;
   long time = 0;
    double latitude = 0;
    double longitude = 0;

    int Eyear, Emonth, Eday;
    static final int dialogId = 0;

    StringRequest request;
    RequestQueue requestQueue;
    SharedPreferences sharedpreferences;
    private final String MyPREFERENCES = "CCPS_PREFERENCE";
    private final String domainName = "DomainAddress";
    private final String Username = "userName";
    private final String Password = "password";
    private final String ID = "id";
    private final String roleName = "rolename";
    private final String CompanyName = "COMPANY_NAME";

    @TargetApi(Build.VERSION_CODES.M)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.submit__duty);

        final String contracSting = getIntent().getStringExtra("Contract");
        sharedpreferences = getSharedPreferences(MyPREFERENCES, Context.MODE_PRIVATE);


        textView = (TextView) findViewById(R.id.textViewOfSubmitDuty);
        nextDate = (EditText) findViewById(R.id.approximateNextDate);
        dutySubmitButton = (Button) findViewById(R.id.submitDutyButton);
        duty_time = (TextView) findViewById(R.id.dutyTime);

        textView.setText(sharedpreferences.getString(CompanyName, ""));

        final Calendar calendar = Calendar.getInstance();
        Eyear = calendar.get(Calendar.YEAR);
        Emonth = calendar.get(Calendar.MONTH);
        Eday = calendar.get(Calendar.DAY_OF_MONTH);

        requestQueue = Volley.newRequestQueue(this);

        final String mainUrl = sharedpreferences.getString(domainName, "");

        JSONObject jsonObject = null;
        String contractId = "";
        int working_time = 0;


        try {
            jsonObject = new JSONObject(contracSting);
            contractId = jsonObject.getString("id");
            working_time = jsonObject.getInt("working_time");
            latitude = jsonObject.getDouble("latitude");
            longitude = jsonObject.getDouble("longitude");

        } catch (JSONException e) {
            e.printStackTrace();
        }

        dutySubmitButton.setEnabled(false);








        nextDate.setOnTouchListener(new View.OnTouchListener() {
            @Override
            public boolean onTouch(View v, MotionEvent event) {
                showDialog(dialogId);
                return false;
            }
        });

        final String date = (new SimpleDateFormat("dd/MM/yyyy").format(Calendar.getInstance().getTime()));
        final String URL = mainUrl + "/?url=mobile/submit_duty";

        final String finalContractId = contractId;

        final int finalWorking_time = working_time;



        timerStart(finalWorking_time);


        dutySubmitButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                request = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {




                        try {
                            JSONObject jsonObject = new JSONObject(response);

                            String result = jsonObject.getString("result");

                            // Toast.makeText(getApplicationContext(),result,Toast.LENGTH_LONG).show();

                            if(result.equals("true"))
                            {
                                Toast.makeText(getApplicationContext(),"Successfully Duty Submitted",Toast.LENGTH_LONG).show();

                            }
                            else
                            {
                                Toast.makeText(getApplicationContext(),"Duty already Submitted",Toast.LENGTH_LONG).show();
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
                        hashMap.put("contractId", finalContractId);
                        hashMap.put("dutyDate",date );
                        hashMap.put("nextDate", nextDate.getText().toString());
                        return hashMap;
                    }
                };

                requestQueue.add(request);

            }
        });



    }

    @Override
    protected Dialog onCreateDialog(int id){

        if(id == dialogId){
            return new DatePickerDialog(this, datepickerListener,Eyear,Emonth,Eday);
        }

        return null;
    }

    private DatePickerDialog.OnDateSetListener datepickerListener = new DatePickerDialog.OnDateSetListener() {
        @Override
        public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
            Eyear = year;
            Emonth = monthOfYear+1;
            Eday = dayOfMonth;

            nextDate.setText(Eday+"/"+Emonth+"/"+Eyear);
        }
    };


    public void timerStart(int finalWorking_time)
    {
        int totalSeconds = finalWorking_time*60;


        new CountDownTimer(1000*totalSeconds,1000){


            @Override
            public void onTick(long millisUntilFinished) {
                long second = millisUntilFinished/1000;
                long minute = second/60;
                long hour = minute/60;
                minute = minute%60;
                long second2 = minute*60;
                second-=second2;

                duty_time.setText("Duty Time Left  "+String.valueOf(hour) +" : " +String.valueOf(minute)+" : "+String.valueOf(second));

                if(time%240==0) {
                    if (!mathcLocation()) {
                        cancel();
                    }
                }
                time++;

               // time = millisUntilFinished;
            }

            @Override
            public void onFinish() {

                dutySubmitButton.setEnabled(true);

            }
        }.start();
    }

    public boolean mathcLocation()
    {
        Gps_Tracker gps_tracker = new Gps_Tracker(getApplicationContext());
        Location location = gps_tracker.getLocation();
        if(location != null)
        {
            int lat = (int) (location.getLatitude()*100);
            int lon = (int)(location.getLongitude()*100);

           // Toast.makeText(getApplicationContext(),String.valueOf(lat)+" "+String.valueOf(lon),Toast.LENGTH_LONG).show();


            int latitudeInt = (int) (latitude*100);
            int longitudeInt = (int) (longitude*100);

            if(lat != latitudeInt || lon != longitudeInt)
            {
                Toast.makeText(getApplicationContext(),"You are in wrong Location",Toast.LENGTH_LONG).show();
                return false;
            }
            else
            {
                Toast.makeText(getApplicationContext(),"Location Checked",Toast.LENGTH_LONG).show();
                return true;
            }


        }

        return false;
    }
}
