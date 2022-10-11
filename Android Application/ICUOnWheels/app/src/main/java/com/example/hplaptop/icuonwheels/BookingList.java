package com.example.hplaptop.icuonwheels;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class BookingList extends AppCompatActivity {

    ListView booklist;
    BookingListAdapter adapter;
    TextView tv1,tv2;
    LinearLayout ll1;
    View v1;
    PrefManager prefManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_booking_list);
        prefManager=new PrefManager(getApplicationContext());
        tv1=findViewById(R.id.booklistlbl);
        tv2=findViewById(R.id.nobooklbl);
        ll1=findViewById(R.id.book_linear);
        booklist=(ListView)findViewById(R.id.bookinglist);
        v1=findViewById(R.id.hr1);

        Pre_bookdata preBookdata=new Pre_bookdata();
        preBookdata.execute();
    }

    public class Pre_bookdata extends AsyncTask<String,String,String>{

        HttpURLConnection connection;
        String[] idlist,hoslist,condlist,timelist;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(String... strings) {
            PrefManager prefManager=new PrefManager(getApplicationContext());
            String amb=prefManager.getName();
            String data=null,text=null;
            BufferedReader reader=null;
            StringBuilder result=new StringBuilder();
            try{
                data= URLEncoder.encode("amb","UTF-8")+"="+URLEncoder.encode(amb,"UTF-8");
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/booking_list.php");
                connection=(HttpURLConnection)url.openConnection();
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");

                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line="";
                while((line=reader.readLine())!=null){
                    result.append(line);
                }
                text=result.toString();

                if(!text.contentEquals("No booking")) {
                    JSONArray jsonArray=new JSONArray(text);
                    JSONObject obj;
                    idlist=new String[jsonArray.length()];
                    hoslist=new String[jsonArray.length()];
                    condlist=new String[jsonArray.length()];
                    timelist=new String[jsonArray.length()];



                    for(int i=0;i<jsonArray.length();i++){
                        obj=jsonArray.getJSONObject(i);
                        idlist[i]=obj.getString("book_id").toString();
                        hoslist[i]=obj.getString("hos_name").toString();
                        condlist[i]=obj.getString("patient_condition").toString();
                        timelist[i]=obj.getString("date_time").toString();
                        Log.i("ID: ",idlist[i]);
                        Log.i("Hospital: ",hoslist[i]);
                        Log.i("Condition: ",condlist[i]);
                        Log.i("TimeStamp: ",timelist[i]);
                    }

                }
            } catch (Exception e){
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
            if (s.contentEquals("No booking")){
                Toast.makeText(getApplicationContext(), "No Booking", Toast.LENGTH_SHORT).show();
            }
            else {
                tv2.setVisibility(View.GONE);
                tv1.setVisibility(View.VISIBLE);
                ll1.setVisibility(View.VISIBLE);
                booklist.setVisibility(View.VISIBLE);
                v1.setVisibility(View.VISIBLE);
                adapter = new BookingListAdapter(BookingList.this, idlist, hoslist, condlist, timelist);
                booklist.setAdapter(adapter);
            }
        }
    }
}
