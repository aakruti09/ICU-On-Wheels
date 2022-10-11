package com.example.hplaptop.icuonwheels;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import static java.net.URLEncoder.encode;

public class Hospital_List extends AppCompatActivity {

    ListView pri_hos,govt_hos;
    String[] pri_list,govt_list;
    ArrayAdapter adapter1,adapter2;
    String lcity,larea,bmedi,bcond,pname,pid;
    PrefManager prefManager;

    public static Activity fa;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hospital__list);
        prefManager=new PrefManager(getApplicationContext());

        fa=this;
        pri_hos=(ListView) findViewById(R.id.private_hos);
        govt_hos=(ListView) findViewById(R.id.govt_hos);

        Get_Hosp_list hos_list=new Get_Hosp_list();
        hos_list.execute();

        Bundle receiver = getIntent().getExtras();
        lcity=receiver.getString("city");
        larea=receiver.getString("area");
        bcond=receiver.getString("condition");
        bmedi=receiver.getString("mediclaim");
        pname=receiver.getString("patient");
        pid=receiver.getString("p_id");

        /*ArrayAdapter adapter= ArrayAdapter.createFromResource(getApplicationContext(),R.array.hospitals,android.R.layout.simple_spinner_dropdown_item);
        pri_hos.setAdapter(adapter);

        pri_hos.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                startActivity(new Intent(getApplicationContext(),Booking.class));
            }
        });*/
    }

    private class Get_Hosp_list extends AsyncTask<String,String,String>{
        HttpURLConnection connection;
        String itemValue,text;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(String... params) {

            BufferedReader reader=null;
            String pri=null,govt=null,data=null;
            StringBuilder res=new StringBuilder();
            StringBuilder result1=new StringBuilder();
            StringBuilder result2=new StringBuilder();

            try{
                data=encode("city","UTF-8")+"="+encode(lcity,"UTF-8");
                data+="&"+encode("area","UTF-8")+"="+encode(larea,"UTF-8");
                data+="&"+encode("condition","UTF-8")+"="+encode(bcond,"UTF-8");
                data+="&"+encode("mediclaim","UTF-8")+"="+encode(bmedi,"UTF-8");
                Log.i("Condition: ",data);
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/hospital_list.php");
                connection=(HttpURLConnection) url.openConnection();
                connection.setRequestMethod("POST");
                connection.setDoOutput(true);

                Log.i("Connection","Done!");
                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();
                Log.i("Data","Written");

                String data1, data2;
                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line = "";
                while((line=reader.readLine())!=null){
                    Log.i("Line get: ",line);
                    if(line.contains("Sorry")) {
                        res.append(line);
                    }
                    else {
                        String temp1=line;
                        Log.i("Temp1",temp1);
                        String[] splited=temp1.split("&");
                        data1=splited[0];
                        data2=splited[1];
                        result1.append(data1);
                        result2.append(data2);
                    }
                }
                text=res.toString();
                pri=result1.toString();
                govt=result2.toString();

                if(text.trim().contentEquals("Sorry no bed in any hospitals yet, Shift to nearest hospital.")) {
                    startActivity(new Intent(getApplicationContext(),Navigator.class));
                    finish();
                }
                else {
                    JSONArray jsonArray1=new JSONArray(pri);
                    JSONArray jsonArray2=new JSONArray(govt);
                    JSONObject jsonObject1,jsonObject2;
                    pri_list=new String[jsonArray1.length()];
                    govt_list=new String[jsonArray2.length()];

                    Log.i("Now JSon","Execution");
                    for(int i=0;i<jsonArray1.length();i++){
                        jsonObject1=jsonArray1.getJSONObject(i);
                        pri_list[i] = jsonObject1.getString("hos_name").toString();
                        Log.i("Private: ",pri_list[i]);
                    }
                    for(int i=0;i<jsonArray2.length();i++){
                        jsonObject2=jsonArray2.getJSONObject(i);
                        govt_list[i] = jsonObject2.getString("hos_name").toString();
                        Log.i("Govt: ",govt_list[i]);
                    }
                }
            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            } finally {
                try{
                    reader.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            return text;
        }

        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);
            if (!result.contains("Sorry")) {
                adapter1=new ArrayAdapter(getApplicationContext(),R.layout.spinner_layout,R.id.txt,pri_list);
                adapter2=new ArrayAdapter(getApplicationContext(),R.layout.spinner_layout,R.id.txt,govt_list);
                pri_hos.setAdapter(adapter1);
                govt_hos.setAdapter(adapter2);
                pri_hos.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                    @Override
                    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                        itemValue = (String) pri_hos.getItemAtPosition(position);
                        Toast.makeText(getApplicationContext(), "List Item : " + itemValue, Toast.LENGTH_SHORT).show();
                        Intent i = new Intent(getApplicationContext(), Booking.class);
                        i.putExtra("condition",bcond);
                        i.putExtra("patient",pname);
                        i.putExtra("p_id",pid);
                        i.putExtra("hos_name", itemValue);
                        startActivity(i);
                    }
                });
                govt_hos.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                    @Override
                    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                        itemValue = (String) govt_hos.getItemAtPosition(position);
                        Toast.makeText(getApplicationContext(), "List Item : " + itemValue, Toast.LENGTH_SHORT).show();
                        Intent i = new Intent(getApplicationContext(), Booking.class);
                        i.putExtra("condition",bcond);
                        i.putExtra("patient",pname);
                        i.putExtra("p_id",pid);
                        i.putExtra("hos_name", itemValue);
                        startActivity(i);
                    }
                });
            }
        }
    }
}
