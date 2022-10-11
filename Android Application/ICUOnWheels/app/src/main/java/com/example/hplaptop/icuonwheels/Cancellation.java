package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
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
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

public class Cancellation extends AppCompatActivity {

    TextView tv,tv2;
    Spinner bookid;
    Button button;
    String book_id;
    PrefManager prefManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cancellation);
        prefManager=new PrefManager(getApplicationContext());

        tv=(TextView)findViewById(R.id.book_id_label);
        tv2=(TextView)findViewById(R.id.no_booking);
        bookid=findViewById(R.id.book_id);
        button=(Button)findViewById(R.id.cancel);
        /*ArrayAdapter adapter= ArrayAdapter.createFromResource(getApplicationContext(),R.array.bookid_spinner,android.R.layout.simple_spinner_dropdown_item);
        bookid.setAdapter(adapter);*/

        Pre_cancellation preCancellation=new Pre_cancellation();
        preCancellation.execute();

        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Cancel cancel=new Cancel();
                cancel.execute();
            }
        });
    }

    private class Pre_cancellation extends AsyncTask<String,String,String>{

        HttpURLConnection connection;
        ArrayAdapter adapter;
        String[] list;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(String... strings) {
            BufferedReader reader=null;
            String data=null,text=null;
            PrefManager prefManager=new PrefManager(getApplicationContext());
            String user_name=prefManager.getName();
            try {
                data= URLEncoder.encode("amb","UTF-8")+"="+URLEncoder.encode(user_name,"UTF-8");
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/pre_cancel.php");
                connection=(HttpURLConnection) url.openConnection();
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");
                Log.i("Connection","Done!!");
                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();
                Log.i("Data sended: ",data);

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line="";
                StringBuilder result=new StringBuilder();
                while((line=reader.readLine())!=null){
                    result.append(line+"\n");
                }
                text=result.toString();
                Log.i("Readed",text);

                if(!text.equals("No Booking")){
                    JSONArray jsonArray=new JSONArray(text);
                    JSONObject obj;
                    list=new String[jsonArray.length()];
                    for(int i=0;i<jsonArray.length();i++){
                        obj=jsonArray.getJSONObject(i);
                        list[i]=obj.getString("book_id").toString();
                        Log.i("JSON data: ",list[i]);
                    }
                }
            } catch (Exception e) {
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
            Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();
            if(s.trim().equals("No booking")){
                tv.setVisibility(View.INVISIBLE);
                bookid.setVisibility(View.INVISIBLE);
                button.setVisibility(View.INVISIBLE);
                tv2.setText("No booking");
            }
            else{
                adapter = new ArrayAdapter(getApplicationContext(), R.layout.spinner_layout, R.id.txt, list);
                bookid.setAdapter(adapter);
                Toast.makeText(getApplicationContext(), "Cancel Spinner", Toast.LENGTH_SHORT).show();
                bookid.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                    @Override
                    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                        book_id=bookid.getSelectedItem().toString();
                        Toast.makeText(getApplicationContext(), book_id, Toast.LENGTH_SHORT).show();
                    }

                    @Override
                    public void onNothingSelected(AdapterView<?> parent) {

                    }
                });
            }
        }
    }

    private class Cancel extends AsyncTask<String,String,String>{
        HttpURLConnection connection;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(String... strings) {
            String text=null;
            BufferedReader reader=null;
            String data=null;
            StringBuilder result=new StringBuilder();

            try
            {
                data=URLEncoder.encode("bookid","UTF-8")+"="+URLEncoder.encode(book_id,"UTF-8");
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/cancelling.php");
                connection=(HttpURLConnection)url.openConnection();
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");

                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line="";
                while ((line=reader.readLine())!=null){
                    result.append(line+"\n");
                }
                text=result.toString();
            } catch (Exception e) {
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
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            Toast.makeText(getApplicationContext(), s, Toast.LENGTH_SHORT).show();
            startActivity(new Intent(getApplicationContext(),Navigator.class));
        }
    }
}
