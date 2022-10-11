package com.example.hplaptop.icuonwheels;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.drawable.BitmapDrawable;
import android.net.Uri;
import android.os.AsyncTask;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.HashMap;
import java.util.Map;
import java.util.regex.Pattern;

import static java.net.URLEncoder.encode;

public class Registration extends AppCompatActivity {

    String ambno,user,pwd,cpwd,doc,sec_que,phno,timestamp;
    EditText et1,et2,et3,et4,et5;
    Button b1;
    ImageView iv;
    PrefManager prefManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registration);
        prefManager=new PrefManager(getApplicationContext());

        iv=(ImageView)findViewById(R.id.pic);
        et1=(EditText)findViewById(R.id.amb_no);
        et2=(EditText)findViewById(R.id.user_name);
        et3=(EditText)findViewById(R.id.password);
        et4=(EditText)findViewById(R.id.confirm);
        et5=(EditText)findViewById(R.id.reg_phno);

        b1=(Button)findViewById(R.id.register);

        iv.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                selectImage();
            }
        });
        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                ambno=et1.getText().toString();
                user=et2.getText().toString();
                pwd=et3.getText().toString();
                cpwd=et4.getText().toString();
                phno=et5.getText().toString();
                if(TextUtils.isEmpty(ambno) || TextUtils.isEmpty(user) || TextUtils.isEmpty(pwd) || TextUtils.isEmpty(cpwd) || TextUtils.isEmpty(phno))
                {
                    Toast.makeText(getApplicationContext(),"Enter all data properly:)", Toast.LENGTH_LONG).show();
                }
                else if (!isUserValid(user)) {
                    et2.setError("Username must start with alphabet. Username length should be between 8 to 20 letters. No special characters allowed.");
                    et2.setFocusable(true);
                }
                else if (!isPasswordValid(pwd)) {
                    et3.setError("Password Length should be greater than 7 letters. "+getString(R.string.error_invalid_password));
                    et3.setFocusable(true);
                }
                else if(!pwd.contentEquals(cpwd)) {
                    et4.setError("Password and confirm passwords are different.");
                    et4.setFocusable(true);
                }
                else if (phno.length()>10 && phno.length()<8) {
                    et5.setError("Enter proper phone number. Length must not be greater then 10.");
                }
                else {
                    Bitmap image = ((BitmapDrawable) iv.getDrawable()).getBitmap();
                    new Back_task(image,"IMG_"+timestamp).execute();
                }
            }
        });
    }

    private boolean isUserValid(String email) {
        return Pattern.matches("^[aA-zZ]\\w{7,19}$",email);
    }

    private boolean isPasswordValid(String password) {
        return password.length() > 7;
    }

    //function to select a image
    private void selectImage(){
        //open album to select image
        Intent gallaryIntent = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
        startActivityForResult(gallaryIntent, 1);
    }


    //This function is called when we pick some image from the album
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == 1 && resultCode == RESULT_OK && data != null){
            //set the selected image to image variable
            Uri image = data.getData();
            iv.setScaleType(ImageView.ScaleType.FIT_XY);
            iv.setImageURI(image);

            //get the current timeStamp and store that in the time Variable
            Long tsLong = System.currentTimeMillis() / 1000;
            timestamp = tsLong.toString();

            Toast.makeText(getApplicationContext(),timestamp,Toast.LENGTH_SHORT).show();
        }
    }

    private String hashMapToUrl(HashMap<String, String> params) throws UnsupportedEncodingException {
        StringBuilder result = new StringBuilder();
        boolean first = true;
        for(Map.Entry<String, String> entry : params.entrySet()){
            if (first)
                first = false;
            else
                result.append("&");

            result.append(encode(entry.getKey(), "UTF-8"));
            result.append("=");
            result.append(encode(entry.getValue(), "UTF-8"));
        }
        Log.i("HashMapToURL",result.toString());
        return result.toString();

    }
    class Back_task extends AsyncTask<String,String,String> {

        private Bitmap image;
        private String name;
        String text=null;

        public Back_task(Bitmap image, String name) {
            this.image=image;
            this.name=name;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            if(prefManager.isInternetOn()){
                Toast.makeText(getApplicationContext(), "Wait a sec..", Toast.LENGTH_SHORT).show();  }
            else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    finish(); }
        }

        @Override
        protected String doInBackground(String... params) {

            // encoding the url for making the post request

            String data= null;

            ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
            image.compress(Bitmap.CompressFormat.JPEG, 100, byteArrayOutputStream);
            String encodeImage = Base64.encodeToString(byteArrayOutputStream.toByteArray(), Base64.DEFAULT);
            HashMap<String, String> detail = new HashMap<>();
            detail.put("name", name);
            detail.put("image", encodeImage);

            try {
                //data = hashMapToUrl(detail);
                data=encode("ambno", "UTF-8")+"="+ encode(ambno,"UTF-8");
                data+="&"+ encode("user","UTF-8")+"="+ encode(user,"UTF-8");
                data+="&"+ encode("pwd","UTF-8")+"="+ encode(pwd,"UTF-8");
                data+="&"+ encode("phno","UTF-8")+"="+ encode(phno,"UTF-8");
                data+="&"+ hashMapToUrl(detail);
                Log.i("Data",data);
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            }

            Log.d("me", "inside the work backend work");
            String text=null;
            BufferedReader reader = null;

            try {
                URL url=new URL("http://192.168.43.177/ICUOnWheels/Android/signUp.php");

                // send post data requestt

                HttpURLConnection connection=(HttpURLConnection) url.openConnection();
                connection.setRequestMethod("POST");
                connection.setDoOutput(true);

                Log.d("me", "after url connection");

                OutputStreamWriter writer=new OutputStreamWriter(connection.getOutputStream());
                writer.write(data);
                writer.flush();

                // getting the responce from the server

                Log.d("me", "after sending the data to the server");

                reader=new BufferedReader(new InputStreamReader(connection.getInputStream()));
                StringBuilder builder=new StringBuilder();
                String temp=null;


                while ((temp=reader.readLine())!=null){

                    // appending the string
                    Log.d("me", "before buffer");

                    builder.append(temp+"\n");
                    Log.d("me", "after buffer");


                }
                text=builder.toString();

            } catch (Exception e) {
                e.printStackTrace();

            }finally {
                try {
                    reader.close();
                } catch (Exception e) {
                    Log.d("its me", "doInBackground: here is problem");
                }
            }
            return text;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            Toast.makeText(getApplicationContext(),s, Toast.LENGTH_LONG).show();
            if(s.trim().contentEquals("Registered"))
            {
                if(prefManager.isInternetOn()){ startActivity(new Intent(getApplicationContext(),LoginActivity.class));  }
                else {  startActivity(new Intent(getApplicationContext(),InternetCheck.class));    }
                finish();
            }
        }
    }
}
