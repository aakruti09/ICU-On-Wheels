package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.support.constraint.ConstraintLayout;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import static android.support.design.widget.Snackbar.LENGTH_SHORT;

public class InternetCheck extends AppCompatActivity {
    Button btn;
    ConstraintLayout l1;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_internet_check);

        l1=(ConstraintLayout) findViewById(R.id.layout1);
        btn=(Button)findViewById(R.id.try_again_btn);
        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                PrefManager obj=new PrefManager(getApplicationContext());
                if(obj.isInternetOn()) {
                    if(obj.isLoggedOut()){
                        finish();
                        startActivity(new Intent(getApplicationContext(),Navigator.class));
                    }
                    else {
                        finish();
                        startActivity(new Intent(getApplicationContext(), LoginActivity.class));
                    }
                }
                else {
                    Snackbar.make(l1,"No Internet Connection Yet",LENGTH_SHORT).show();
                }
            }
        });

    }
}
