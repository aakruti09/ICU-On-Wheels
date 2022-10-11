package com.example.hplaptop.icuonwheels;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.AsyncTask;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.telephony.SmsManager;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.net.URL;
import java.net.URLEncoder;

public class Booking extends AppCompatActivity implements MsgDialog.MsgDialogListener{

    String hospital_name,condition,patient_name,bed,pid,bid;
    TextView thos,tname,tcond,tbed_type,tempty_bed,trate,tmedi,smslink,newlink,dirlink;
    Button book_btn;
    PrefManager prefManager;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_booking);
        prefManager=new PrefManager(getApplicationContext());
        smslink=(TextView)findViewById(R.id.resend_sms_link);
        newlink=(TextView)findViewById(R.id.new_book_link);
        dirlink=(TextView)findViewById(R.id.direction_link);
        thos=(TextView)findViewById(R.id.hosname);
        tname=(TextView)findViewById(R.id.p_name);
        tcond=(TextView)findViewById(R.id.pat);
        tbed_type=(TextView)findViewById(R.id.bedtype);
        tempty_bed=(TextView)findViewById(R.id.qty);
        trate=(TextView)findViewById(R.id.rate);
        tmedi=(TextView)findViewById(R.id.medi);
        book_btn=(Button)findViewById(R.id.book_btn);

        Bundle receiver = getIntent().getExtras();
        hospital_name=receiver.getString("hos_name");
        condition=receiver.getString("condition");
        patient_name=receiver.getString("patient");
        pid=receiver.getString("p_id");
        thos.setText(hospital_name);
        tname.setText(patient_name);
        tcond.setText(condition);

        smslink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openDialog();
            }
        });
        newlink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getApplicationContext(),Location.class));
                finish();
            }
        });
        dirlink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String[] hos=hospital_name.split(" ");
                Log.i("Splitted: ",hos.toString());
                String hosplus= TextUtils.join("+",hos);
                Log.i("Joined: ",hosplus);
                Uri gmmIntentUri = Uri.parse("google.navigation:q="+hosplus+",+Ahmedabad+Gujarat+India");
                Intent mapIntent = new Intent(Intent.ACTION_VIEW, gmmIntentUri);
                mapIntent.setPackage("com.google.android.apps.maps");
                startActivity(mapIntent);
            }
        });

        if(!checkPermission(Manifest.permission.SEND_SMS)){
            ActivityCompat.requestPermissions(this,
                    new String[]{Manifest.permission.SEND_SMS}, 1);
        }

        Booking_Pre_Data bookingPreData=new Booking_Pre_Data();
        bookingPreData.execute();

        book_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Book book=new Book();
                book.execute();
                Hospital_List.fa.finish();

            }
        });
    }

    public void openDialog(){
        MsgDialog msgDialog=new MsgDialog();
        msgDialog.show(getSupportFragmentManager(),"Message Dialog");
    }

    public  boolean checkPermission(String permission){
        int check= ContextCompat.checkSelfPermission(this,permission);
        return (check== PackageManager.PERMISSION_GRANTED);
    }

    @Override

    public void applyTexts(String username) {
        String body="Booking id: "+bid+"\nPatient id:"+pid;
        try{
            SmsManager smsManager=SmsManager.getDefault();
            smsManager.sendTextMessage(username,null,body,null,null);
            Toast.makeText(getApplicationContext(), "Message sent", Toast.LENGTH_LONG).show();
        } catch (Exception e){
            Toast.makeText(getApplicationContext(), "Message not sent", Toast.LENGTH_LONG).show();
        }
    }

    private class Book extends AsyncTask<String,String,String>{

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
            String data=null,text=null;
            PrefManager prefManager=new PrefManager(getApplicationContext());
            String user_name=prefManager.getName();
            BufferedReader reader=null;
            Log.i("Username",user_name);
            try{
                data= URLEncoder.encode("hos_name","UTF-8")+"="+URLEncoder.encode(hospital_name,"UTF-8");
                data+= "&"+URLEncoder.encode("condition","UTF-8")+"="+URLEncoder.encode(condition,"UTF-8");
                data+= "&"+URLEncoder.encode("user_name","UTF-8")+"="+URLEncoder.encode(user_name,"UTF-8");
                data+= "&"+URLEncoder.encode("bed_type","UTF-8")+"="+URLEncoder.encode(bed,"UTF-8");
                data+= "&"+URLEncoder.encode("pid","UTF-8")+"="+URLEncoder.encode(pid,"UTF-8");

                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/booking.php");
                connection=(HttpURLConnection) url.openConnection();
                connection.setRequestMethod("POST");
                connection.setDoOutput(true);
                Log.i("Connection","Done!!");
                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();
                Log.i("Output: ",data);

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                StringBuilder builder=new StringBuilder();
                String temp=null;
                while ((temp=reader.readLine())!=null){
                    builder.append(temp+"\n");
                }
                text=builder.toString();
            } catch (Exception e) {
                e.printStackTrace();
            } finally {
                try{
                    reader.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            Log.i("Text: ",text);
            return text;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            Log.i("In post: ",s);
            if(s.trim()=="No"){
                Toast.makeText(getApplicationContext(),"Sorry cant book bed some error occured or no bed is empty",Toast.LENGTH_LONG).show();
            }
            else{
                bid=s;
                Toast.makeText(getApplicationContext(),"Patient id: "+pid+"\nBooking id: "+s,Toast.LENGTH_LONG).show();
                openDialog();
                smslink.setVisibility(View.VISIBLE);
                dirlink.setVisibility(View.VISIBLE);
                newlink.setVisibility(View.VISIBLE);
            }
        }
    }

    private class Booking_Pre_Data extends AsyncTask<String,String,String>{

        HttpURLConnection connection;
        String j_type,j_empty,j_rate,j_medi;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(String... params) {
            String data=null,d_bed,d_info,d_medi;
            BufferedReader reader=null;
            StringBuilder result1=new StringBuilder();
            StringBuilder result2=new StringBuilder();
            StringBuilder result3=new StringBuilder();
            try{
                data= URLEncoder.encode("hos_name","UTF-8")+"="+URLEncoder.encode(hospital_name,"UTF-8");
                data+= "&"+URLEncoder.encode("condition","UTF-8")+"="+URLEncoder.encode(condition,"UTF-8");

                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/pre_booking.php");
                connection=(HttpURLConnection) url.openConnection();
                connection.setRequestMethod("POST");
                connection.setDoOutput(true);
                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();
                Log.i("Connection","Done!!");
                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String line="",data1=null,data2=null,data3=null;
                while((line=reader.readLine())!=null){
                    String temp=line;
                    String[] splited=temp.split("&");
                    data1=splited[0];
                    data2=splited[1];
                    data3=splited[2];
                    result1.append(data1);
                    result2.append(data2);
                    result3.append(data3);
                }
                d_bed=data1.toString();
                d_info=data2.toString();
                d_medi=data3.toString();

                JSONArray jsonArray1=new JSONArray(d_bed);
                JSONArray jsonArray2=new JSONArray(d_info);
                JSONArray jsonArray3=new JSONArray(d_medi);
                JSONObject obj1,obj2,obj3;

                for(int i=0;i<jsonArray1.length();i++){
                    obj1=jsonArray1.getJSONObject(i);
                    j_type = obj1.getString("bed_type").toString();
                    bed=j_type;
                    Log.i("Bed type: ",j_type);
                }
                for(int i=0;i<jsonArray2.length();i++){
                    obj2=jsonArray2.getJSONObject(i);
                    j_empty = obj2.getString("empty_beds").toString();
                    j_rate=obj2.getString("rate_per_day").toString();
                    Log.i("Empty beds and Rate: ",j_empty+j_rate);
                }
                for(int i=0;i<jsonArray3.length();i++){
                    obj3=jsonArray3.getJSONObject(i);
                    j_medi = obj3.getString("madiclaim").toString();
                    Log.i("Mediclaim: ",j_medi);
                }
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
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
            return null;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            tbed_type.setText(j_type);
            tempty_bed.setText(j_empty);
            trate.setText(j_rate);
            tmedi.setText(j_medi);
        }
    }
}
