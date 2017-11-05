package com.example.ryhanahmedtamim.ccps;

import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.widget.Toast;

/**
 * Created by Ryhan Ahmed Tamim on 10/23/2017.
 */
public class Gps_Tracker implements LocationListener {

    Context context;

    public Gps_Tracker(Context context) {
        this.context = context;
    }


    public Location getLocation() {
        LocationManager lm = (LocationManager) context.getSystemService(Context.LOCATION_SERVICE);
        boolean enLc = lm.isProviderEnabled(LocationManager.NETWORK_PROVIDER);
        if (ContextCompat.checkSelfPermission(context,Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ContextCompat.checkSelfPermission(context, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // TODO: Consider calling
            //    ActivityCompat#requestPermissions
            // here to request the missing permissions, and then overriding
            //   public void onRequestPermissionsResult(int requestCode, String[] permissions,
            //                                          int[] grantResults)
            // to handle the case where the user grants the permission. See the documentation
            // for ActivityCompat#requestPermissions for more details.
            Toast.makeText(context,"Please Turn One your GPS1", Toast.LENGTH_LONG).show();
            return null;
        }

        if (enLc) {

            lm.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 5000, 5, this);
            Location location = lm.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
            return location;
        }else {
            Toast.makeText(context,"Please Turn One your GPS", Toast.LENGTH_LONG).show();
        }
        return  null;
    }


    @Override
    public void onLocationChanged(Location location) {

    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {

    }

    @Override
    public void onProviderEnabled(String provider) {

    }

    @Override
    public void onProviderDisabled(String provider) {

    }
}
