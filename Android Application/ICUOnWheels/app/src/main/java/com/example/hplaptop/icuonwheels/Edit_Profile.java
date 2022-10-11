package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
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

public class Edit_Profile extends AppCompatActivity {

    EditText editphno;
    Button btn;
    String phone_data;
    PrefManager prefManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit__profile);
        prefManager=new PrefManager(getApplicationContext());

        editphno=(EditText) findViewById(R.id.edit_phno);
        btn=(Button) findViewById(R.id.pro_update);
        Pre_Profile_Data preProfileData=new Pre_Profile_Data();
        preProfileData.execute();

        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                phone_data=editphno.getText().toString();
                Update_Profile updateProfile=new Update_Profile();
                updateProfile.execute();
            }
        });
    }

    private class Update_Profile extends AsyncTask<Void,Void,String>{
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(Void... voids) {
            String text=null;
            BufferedReader reader=null;
            StringBuilder result=new StringBuilder();
            PrefManager prefManager=new PrefManager(getApplicationContext());
            String user=prefManager.getName();
            try {
                String data= URLEncoder.encode("amb","UTF-8")+"="+URLEncoder.encode(user,"UTF-8");
                data+="&"+URLEncoder.encode("phno","UTF-8")+"="+URLEncoder.encode(phone_data,"UTF-8");
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/update_profile.php");
                HttpURLConnection connection=(HttpURLConnection) url.openConnection();
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");
                Log.i("Connection","Done!!");

                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line="";
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
            return text;        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            Toast.makeText(getApplicationContext(), s, Toast.LENGTH_SHORT).show();
            if (s.trim().contentEquals("Data Updated")) {
                startActivity(new Intent(getApplicationContext(),View_Profile.class));
                finish();
            }
        }

    }

    private class Pre_Profile_Data extends AsyncTask<Void,Void,String>{
        String getphno;
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(Void... voids) {
            String text=null;
            BufferedReader reader=null;
            StringBuilder result=new StringBuilder();
            PrefManager prefManager=new PrefManager(getApplicationContext());
            String user=prefManager.getName();
            try {
                String data= URLEncoder.encode("amb","UTF-8")+"="+URLEncoder.encode(user,"UTF-8");
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/pre_profile.php");
                HttpURLConnection connection=(HttpURLConnection) url.openConnection();
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");
                Log.i("Connection","Done!!");

                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line="";
                while ((line=reader.readLine())!=null) {
                    result.append(line);
                }
                text=result.toString();
                JSONArray jsonArray=new JSONArray(text);
                JSONObject object;
                for(int i=0;i<jsonArray.length();i++) {
                    object=jsonArray.getJSONObject(i);
                    getphno=object.getString("phno").toString();
                    Log.i("JSON data",getphno);
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
            editphno.setText(getphno);
        }
    }
}
