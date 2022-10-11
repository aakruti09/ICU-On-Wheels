package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.design.widget.CoordinatorLayout;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class RequestFacility extends AppCompatActivity {

    CoordinatorLayout coordinatorLayout;
    ArrayAdapter<String> adapter;
    EditText ed1,ed2;
    Spinner fspinner;
    Button appeal_btn;
    String fac1,ofac1,qty1;
    PrefManager prefManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_request_facility);
        prefManager=new PrefManager(getApplicationContext());

        fspinner=(Spinner) findViewById(R.id.flist);
        ed1=(EditText) findViewById(R.id.o_cond);
        ed2=(EditText) findViewById(R.id.fqty);
        appeal_btn=(Button) findViewById(R.id.appealing_btn);

        Pre_Req_Facility preReqFacility=new Pre_Req_Facility();
        preReqFacility.execute();

        appeal_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                fac1=fspinner.getSelectedItem().toString();
                ofac1=ed1.getText().toString();
                qty1=ed2.getText().toString();
                RequestFac requestFac=new RequestFac();
                requestFac.execute();
            }
        });
    }

    private class RequestFac extends AsyncTask<Void,Void,String>{
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(Void... voids) {
            PrefManager prefManager=new PrefManager(getApplicationContext());
            String amb=prefManager.getName();
            String data=null,text=null;
            BufferedReader reader=null;
            StringBuilder result=new StringBuilder();
            HttpURLConnection connection;

            try {
                data= URLEncoder.encode("amb","UTF-8")+"="+URLEncoder.encode(amb,"UTF-8");
                data+="&"+URLEncoder.encode("fac","UTF-8")+"="+URLEncoder.encode(fac1,"UTF-8");
                data+="&"+URLEncoder.encode("ofac","UTF-8")+"="+URLEncoder.encode(ofac1,"UTF-8");
                data+="&"+URLEncoder.encode("qty","UTF-8")+"="+URLEncoder.encode(qty1,"UTF-8");

                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/request_facility.php");
                connection=(HttpURLConnection)url.openConnection();
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");
                Log.i("Connection","Done !!");

                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line=null;
                while ((line=reader.readLine())!=null) {
                    result.append(line);
                }
                text=result.toString();

            } catch (IOException e) {
                e.printStackTrace();
            } finally {
                try {
                    reader.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            return text;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();
        }
    }

    private class Pre_Req_Facility extends AsyncTask<Void,Void,String>{
        String[] flist;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(Void... voids) {
            HttpURLConnection connection;
            String text=null;
            StringBuilder result=new StringBuilder();
            BufferedReader reader=null;

            try {
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/pre_facility.php");
                connection=(HttpURLConnection)url.openConnection();
                connection.setDoInput(true);
                Log.i("Connection: ","Done!!");
                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line=null;
                while((line=reader.readLine())!=null){
                    result.append(line);
                }
                text=result.toString();
                Log.i("Data received: ",text);
                JSONArray jsonArray=new JSONArray(text);
                JSONObject obj;
                flist=new String[jsonArray.length()];
                for(int i=0;i<jsonArray.length();i++) {
                    obj=jsonArray.getJSONObject(i);
                    flist[i]=obj.getString("facility_name").toString();
                    Log.i("JSON data: ",flist[i]);
                }
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            } finally {
                try {
                    reader.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            return text;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            adapter=new ArrayAdapter<>(getApplicationContext(),R.layout.spinner_layout,R.id.txt,flist);
            fspinner.setAdapter(adapter);
            fspinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                @Override
                public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                    String str=fspinner.getSelectedItem().toString();
                    if(str.contentEquals("Other")){
                        ed1.setEnabled(true);
                    }
                    else {
                        ed1.setEnabled(false);
                    }
                }

                @Override
                public void onNothingSelected(AdapterView<?> parent) {

                }
            });
        }
    }
}
