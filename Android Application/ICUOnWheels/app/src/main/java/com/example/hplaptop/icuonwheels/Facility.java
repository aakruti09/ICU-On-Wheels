package com.example.hplaptop.icuonwheels;

import android.content.AsyncQueryHandler;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
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

public class Facility extends AppCompatActivity {

    ListView facList;
    FacilityListAdapter adapter;
    TextView fac_lbl;
    FloatingActionButton add_btn,req_btn;
    PrefManager prefManager;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_facility);
        prefManager=new PrefManager(getApplicationContext());

        add_btn=(FloatingActionButton) findViewById(R.id.add_float);
        req_btn=(FloatingActionButton) findViewById(R.id.request_float);
        fac_lbl=(TextView)findViewById(R.id.fac_lbl);
        facList =(ListView) findViewById(R.id.facility_list);
        /*ArrayAdapter adapter= ArrayAdapter.createFromResource(getApplicationContext(),R.array.facility_list,android.R.layout.simple_spinner_dropdown_item);
        lv.setAdapter(adapter);*/
        new Fac_list().execute();

        add_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),Add_facility.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
                finish();
            }
        });
        req_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),RequestFacility.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
                finish();
            }
        });
    }

    private class Fac_list extends AsyncTask<Void,Void,String>{
        String[] fnamelist,qtylist;
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
            BufferedReader reader=null;
            String data=null,text=null;


            PrefManager prefManager=new PrefManager(getApplicationContext());
            String amb=prefManager.getName();

            try {
                data= URLEncoder.encode("amb","UTF-8")+"="+URLEncoder.encode(amb,"UTF-8");
                Log.i("Data: ",data);
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/facility_list.php");
                connection=(HttpURLConnection)url.openConnection();
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");
                Log.i("Connection: ","Done !!");

                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();
                Log.i("Data Sended",data);

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line="";
                StringBuilder result=new StringBuilder();
                while ((line=reader.readLine())!=null) {
                    result.append(line);
                }
                text=result.toString();
                if (!text.contentEquals("No records")) {
                    JSONArray json1=new JSONArray(text);
                    JSONObject obj;
                    fnamelist=new String[json1.length()];
                    qtylist=new String[json1.length()];
                    for (int i=0;i<json1.length();i++) {
                        obj=json1.getJSONObject(i);
                        fnamelist[i]=obj.getString("facility_name").toString();
                        qtylist[i]=obj.getString("quantity").toString();
                        Log.i("Json data: ",fnamelist[i]+" "+qtylist[i]);
                    }
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

            if (s.trim().contentEquals("No records")) {
                fac_lbl.setVisibility(View.INVISIBLE);
                facList.setVisibility(View.INVISIBLE);
            }
            else {
                adapter = new FacilityListAdapter(Facility.this,fnamelist,qtylist);
                facList.setAdapter(adapter);
            }

        }

    }
}
