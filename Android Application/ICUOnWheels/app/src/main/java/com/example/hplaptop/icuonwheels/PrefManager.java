package com.example.hplaptop.icuonwheels;

import android.content.Context;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.support.design.widget.Snackbar;
import android.widget.Toast;

public class PrefManager {
    Context context;

    public PrefManager(Context context) {
        this.context = context;
    }

    public void saveLogindetails(String uname){
        SharedPreferences sharedPreferences=context.getSharedPreferences("ICUOnWheels",Context.MODE_PRIVATE);
        SharedPreferences.Editor editor=sharedPreferences.edit();
        editor.putString("Username",uname);
        editor.commit();
    }

    public String getName(){
        SharedPreferences sharedPreferences=context.getSharedPreferences("ICUOnWheels",Context.MODE_PRIVATE);
        return sharedPreferences.getString("Username","");
    }

    public boolean isLoggedOut(){
        SharedPreferences sharedPreferences=context.getSharedPreferences("ICUOnWheels",Context.MODE_PRIVATE);
        boolean name=sharedPreferences.getString("Username","").isEmpty();
        return name;
    }

    public final boolean isInternetOn() {
        // get Connectivity Manager object to check connection
        //ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        //NetworkInfo nInfo = cm.getActiveNetworkInfo();
        //connected = nInfo != null && nInfo.isAvailable() && nInfo.isConnected();
        //return connected;
        ConnectivityManager connec = (ConnectivityManager)context.getSystemService(Context.CONNECTIVITY_SERVICE);

        // Check for network connections
        if ( connec.getNetworkInfo(0).getState() == android.net.NetworkInfo.State.CONNECTED ||
                connec.getNetworkInfo(0).getState() == android.net.NetworkInfo.State.CONNECTING ||
                connec.getNetworkInfo(1).getState() == android.net.NetworkInfo.State.CONNECTING ||
                connec.getNetworkInfo(1).getState() == android.net.NetworkInfo.State.CONNECTED ) {

            // if connected with internet
            //Snackbar.make(lay,"Connected",Snackbar.LENGTH_LONG).show();
            //Toast.makeText(context, " Connected ", Toast.LENGTH_LONG).show();
            return true;

        } else if (
                connec.getNetworkInfo(0).getState() == android.net.NetworkInfo.State.DISCONNECTED ||
                        connec.getNetworkInfo(1).getState() == android.net.NetworkInfo.State.DISCONNECTED  ) {

            //Snackbar.make(lay,"Not Connected",Snackbar.LENGTH_LONG).show();
            //Toast.makeText(context, " Not Connected ", Toast.LENGTH_LONG).show();
            return false;
        }
        return false;
    }
}
