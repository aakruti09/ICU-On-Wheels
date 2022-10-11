package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class Reset_Pwd extends AppCompatActivity {


    EditText ed1,ed2;
    PrefManager prefManager;
    String amb_name,rpwd,rcpwd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reset__pwd);

        prefManager=new PrefManager(getApplicationContext());

        ed1=(EditText)findViewById(R.id.rnew_pwd);
        ed2=(EditText)findViewById(R.id.rconfirm_pwd);
        Bundle receiver = getIntent().getExtras();
        amb_name=receiver.getString("amb");


        Button b=findViewById(R.id.rdone);
        b.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                rpwd=ed1.getText().toString();
                rcpwd=ed2.getText().toString();
                if(rpwd.contentEquals("") || rcpwd.contentEquals(""))
                {
                    Toast.makeText(getApplicationContext(), "Enter all data !!", Toast.LENGTH_SHORT).show();
                }
                else if(rpwd.length()<=7){
                    ed1.setError("Password length must be greater than 7.");
                    ed1.setFocusable(true);
                }
                else if(!rpwd.contentEquals(rcpwd)){
                    ed2.setError("New Password and Confirm Password is different");
                    ed2.setFocusable(true);
                }
                else{
                    Reseting reseting=new Reseting();
                    reseting.execute();
                }
            }
        });
    }

    class Reseting extends AsyncTask<Void,Void,String>{
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(Void... voids) {
            String data=null,text=null;
            BufferedReader reader=null;
            StringBuilder result=new StringBuilder();
            HttpURLConnection connection;

            try {
                data= URLEncoder.encode("amb","UTF-8")+"="+URLEncoder.encode(amb_name,"UTF-8");
                data+="&"+URLEncoder.encode("pwd","UTF-8")+"="+URLEncoder.encode(rpwd,"UTF-8");

                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/reset_pwd.php");
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
            Toast.makeText(getApplicationContext(), s, Toast.LENGTH_SHORT).show();
            if(s.trim().contentEquals("Done")){
                startActivity(new Intent(getApplicationContext(),LoginActivity.class));
                finish();
            }
        }
    }
}
