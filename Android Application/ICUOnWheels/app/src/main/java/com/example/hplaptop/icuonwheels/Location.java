package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Spinner;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

public class Location extends AppCompatActivity {

    String csel;
    Spinner city;
    ListView area;
    ArrayAdapter adapter,adapter1;
    HttpURLConnection urlConnection;
    String[] list,values;
    PrefManager prefManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_location);
        prefManager=new PrefManager(getApplicationContext());

        city=(Spinner) findViewById(R.id.city);
        area=findViewById(R.id.area);

        Display_city bt1=new Display_city();
        bt1.execute();

        city.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                csel = city.getSelectedItem().toString();
                BackTask bt = new BackTask();
                bt.execute();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });
    }

    private class BackTask extends AsyncTask<String,String,String> {

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  finish();   startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
        }

        protected String doInBackground(String... params) {
            InputStream is = null;
            StringBuilder result = new StringBuilder();
            String temp = null;
            BufferedReader bufferedReader = null;

            String data= null;
            try {

                data = URLEncoder.encode("city", "UTF-8")+"="+URLEncoder.encode(csel,"UTF-8");

            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            }

            try {
                URL url = new URL("http://192.168.43.177/ICUOnWheels/Android/area.php");
                urlConnection = (HttpURLConnection) url.openConnection();
                urlConnection.setDoOutput(true);
                OutputStreamWriter writer = new OutputStreamWriter(urlConnection.getOutputStream());
                writer.write(data);
                writer.flush();
                is = urlConnection.getInputStream();
                Log.i("problem is not","connected to php file ");
            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            try {

                Log.i("problem is here", "doInBackground: 0 ");
                bufferedReader = new BufferedReader(new InputStreamReader(urlConnection.getInputStream()));
                String line = "";
                while ((line = bufferedReader.readLine()) != null) {
                    result.append(line + "\n");


                    Log.i("problem is here", "doInBackground: 1 ");
                }
                temp = result.toString();

            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } finally {
                try {
                    bufferedReader.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }

            try {

                JSONArray jsonArray = new JSONArray(temp);
                values = new String[jsonArray.length()];

                for (int j = 0; j < jsonArray.length(); j++) {
                    JSONObject jsonObject = jsonArray.getJSONObject(j);
                    values[j] = jsonObject.getString("area_name").toString();
                }



            } catch (JSONException e) {
                e.printStackTrace();
            }
            return null;
        }

        protected void onPostExecute(String result) {
            adapter = new ArrayAdapter(getApplicationContext(),R.layout.spinner_layout,R.id.txt, values);
            area.setAdapter(adapter);
            if(prefManager.isInternetOn()){
                area.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                    @Override
                    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                        String itemValue = (String) area.getItemAtPosition(position);
                        Toast.makeText(getApplicationContext(), "List Item : " + itemValue, Toast.LENGTH_SHORT).show();
                        String s = itemValue;
                        Intent i = new Intent(getApplicationContext(), Patient.class);
                        i.putExtra("area", s);
                        i.putExtra("city",csel);
                        startActivity(i);
                    }
                });
            }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));   finish();  }
        }
    }

    private class Display_city extends AsyncTask<Void, Void, Void> {

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        protected Void doInBackground(Void... params) {
            InputStream is = null;
            StringBuilder result = new StringBuilder();
            String temp = null;
            BufferedReader bufferedReader = null;
            try {
                URL url = new URL("http://192.168.43.177/ICUOnWheels/Android/location.php");
                urlConnection = (HttpURLConnection) url.openConnection();
                is = urlConnection.getInputStream();

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            try {
                Log.i("problem is here", "doInBackground: 0 ");
                bufferedReader = new BufferedReader(new InputStreamReader(urlConnection.getInputStream()));
                String line = "";
                while ((line = bufferedReader.readLine()) != null) {
                    result.append(line + "\n");

                    Log.i("problem is here", "doInBackground: 1 ");
                }
                temp = result.toString();
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } finally {
                try {
                    bufferedReader.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }

            try {

                JSONArray jsonArray = new JSONArray(temp);
                list = new String[jsonArray.length()];

                for (int j = 0; j < jsonArray.length(); j++) {
                    JSONObject jsonObject = jsonArray.getJSONObject(j);
                    list[j] = jsonObject.getString("city").toString();
                    Log.i("json", "list[j]");
                }


            } catch (JSONException e) {
                e.printStackTrace();
            }
            Log.i("I'm"," In Post Execute");
            return null;
        }

        protected void onPostExecute(Void result) {
            Log.i("I'm"," In Post Execute");
            Toast.makeText(getApplicationContext(), "City Spinner :-)", Toast.LENGTH_SHORT).show();
            adapter=new ArrayAdapter(getApplicationContext(),R.layout.spinner_layout,R.id.txt,list);
            city.setAdapter(adapter);
        }
    }
}
