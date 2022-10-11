package com.example.hplaptop.icuonwheels;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v4.view.ViewPager;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.Timer;
import java.util.TimerTask;

public class Navigator extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {


    ViewPager viewPager;
    TextView tv1;
    PrefManager prefManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_navigator);

        ImageView book_img,facility_img,booking_img,doctor_img,cancel_img,clinic_img,profile_img,maps_img;
        book_img=findViewById(R.id.book_img);
        facility_img=findViewById(R.id.facility_img);
        booking_img=findViewById(R.id.booking_img);
        doctor_img=findViewById(R.id.doctor_img);
        cancel_img=findViewById(R.id.cancel_img);
        clinic_img=findViewById(R.id.clinic_img);
        profile_img=findViewById(R.id.profile_img);
        maps_img=findViewById(R.id.maps_img);


        prefManager=new PrefManager(getApplicationContext());
        String user_name=prefManager.getName();

        book_img.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),Location.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
            }
        });

        facility_img.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),Facility.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
            }
        });

        booking_img.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),BookingList.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
            }
        });

        doctor_img.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),Nurse.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
            }
        });

        cancel_img.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),Cancellation.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
            }
        });

        clinic_img.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),Clinic_List.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
            }
        });

        profile_img.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),View_Profile.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
            }
        });

        maps_img.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),MapsActivity.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
            }
        });


        viewPager=(ViewPager)findViewById(R.id.viewPager);
        ViewPagerAdapter viewPagerAdapter=new ViewPagerAdapter(this);
        viewPager.setAdapter(viewPagerAdapter);

        Timer timer=new Timer();
        timer.scheduleAtFixedRate(new Navigator.MyTimerTask(),2000,4000);

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer,toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        View header=navigationView.getHeaderView(0);
        tv1=(TextView) header.findViewById(R.id.nav_username);
        tv1.setText(user_name);
    }

    public class MyTimerTask extends TimerTask {

        @Override
        public void run() {
            Navigator.this.runOnUiThread(new Runnable() {
                @Override
                public void run() {
                    if(viewPager.getCurrentItem() == 0){
                        viewPager.setCurrentItem(1);
                    }else if(viewPager.getCurrentItem() == 1){
                        viewPager.setCurrentItem(2);
                    }else if(viewPager.getCurrentItem() == 2){
                        viewPager.setCurrentItem(3);
                    }else if(viewPager.getCurrentItem() == 3){
                        viewPager.setCurrentItem(4);
                    }else{
                        viewPager.setCurrentItem(0);
                    }
                }
            });
        }
    }
    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.navigator, menu);
        return true;
    }

    /*@Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }*/

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.book_bed) {
            if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),Location.class));  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
        } else if (id == R.id.cancel_bed) {
            if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),Cancellation.class));  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
        } else if (id == R.id.view_booking) {
            if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),BookingList.class));  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
        } else if (id == R.id.facility) {
            if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),Facility.class));  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
        } else if (id == R.id.profile) {
            if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),View_Profile.class));  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
        } else if (id == R.id.change_paswd) {
            if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),Change_Pwd.class));  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
        } else if (id == R.id.logout) {
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(),new PrefManager(getApplicationContext()).getName(),Toast.LENGTH_LONG).show();
                SharedPreferences preferences=getSharedPreferences("ICUOnWheels", Context.MODE_PRIVATE);
                SharedPreferences.Editor editor=preferences.edit();
                editor.clear();
                editor.commit();
                finish();
                if(new PrefManager(getApplicationContext()).isLoggedOut()){
                    startActivity(new Intent(getApplicationContext(),LoginActivity.class));
                }
            }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
}
