package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class Splash extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        Thread thread=new Thread() {
            public void run() {
                try
                {
                    sleep(3000);
                }
                catch (InterruptedException ie)
                {
                    ie.printStackTrace();
                }
                finally
                {
                    PrefManager obj=new PrefManager(getApplicationContext());
                    if(obj.isInternetOn()) {
                        String amb=obj.getName().toString();
                        if (obj.isLoggedOut() || amb.contentEquals("")) {
                            startActivity(new Intent(getApplicationContext(), LoginActivity.class));
                        } else {
                            startActivity(new Intent(getApplicationContext(), Navigator.class));
                        }
                    }
                    else {
                        startActivity(new Intent(getApplicationContext(),InternetCheck.class));
                    }
                }
            }
        };
        thread.start();
    }
    @Override
    protected void onPause() {
        // TODO Auto-generated method stub
        super.onPause();
        finish();
    }
}

