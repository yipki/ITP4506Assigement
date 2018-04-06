package com.example.aaddr.test03;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Build;
import android.support.annotation.RequiresApi;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.darwindeveloper.horizontalscrollmenulibrary.custom_views.HorizontalScrollMenuView;
import com.darwindeveloper.horizontalscrollmenulibrary.extras.MenuItem;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

public class Main2Activity extends AppCompatActivity {

    Button btnEx;
    EditText edEx;
    TextView tvEx, totalSp, sumEx;
    String userEx;
    String dataUrl = "http://fyp1718.onlinewebshop.net/php/employer/monthlyReport.php";
    ProgressBar progressBar;
    HorizontalScrollMenuView menu;

    //DecoView decoView;

    @Override

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);

        progressBar = (ProgressBar)findViewById(R.id.progressBar);
        btnEx = (Button) findViewById(R.id.btnEx);
        edEx = (EditText) findViewById(R.id.edEx);
        tvEx = (TextView) findViewById(R.id.tvEx);
        totalSp = (TextView)findViewById(R.id.totalSp);
        sumEx = (TextView)findViewById(R.id.sumEx);
        menu = (HorizontalScrollMenuView)findViewById(R.id.menu);
        initMenu();


//        DecoView decoView = (DecoView)findViewById(R.id.decoView);
//
//        SeriesItem seriesItem = new SeriesItem.Builder(Color.parseColor("#FFE2E2E2"))
//                .setRange(0, 50, 0)
//                .build();
//        int backIndex = decoView.addSeries(seriesItem);


//        ObjectAnimator anim = ObjectAnimator.ofInt(progressBar, "progress", 0, 100);
//        anim.setDuration(15000);
//        anim.setInterpolator(new DecelerateInterpolator());
//        anim.start();

        btnEx.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
             GetDataFromEditText();

             SendDataToServer(userEx);
             tvEx.setText("Monthly Budget: " + userEx);
            //    prg.setProgress(50);
                if (edEx.getText()== null) {
                   edEx.setError("Empty expense field");
                    // Toast.makeText(Main2Activity.this, "Empty Expense field", Toast.LENGTH_LONG).show();
                return;
                }else {
                    fetchDataEx process = new fetchDataEx();
                    process.execute();
                    edEx.setText("");
                }
            }
        });


    }
    private void initMenu() {
        menu.addItem("Ex Report",R.drawable.ic_report);
        menu.addItem("Diet Report",R.drawable.ic_dietre );
        menu.addItem("Set Budget",R.drawable.ic_setex);


        menu.setOnHSMenuClickListener(new HorizontalScrollMenuView.OnHSMenuClickListener() {
            @Override
            public void onHSMClick(MenuItem menuItem, int position) {

                //  Toast.makeText(MonthlyReport.this, "asdasdas", Toast.LENGTH_LONG).show();
                // if(menuItem.isSelected()) {

                if (menuItem.getText() == "Ex Report") {
                       startActivity(new Intent(Main2Activity.this, MonthlyReport.class));
//                    MonthlyReport.fetchData process = new MonthlyReport.fetchData();
//                    process.execute();
                }else if (menuItem.getText() == "Diet Report") {
                     startActivity(new Intent(Main2Activity.this, MonthlyReport.class));
//                    MonthlyReport.fetchData1 process = new MonthlyReport.fetchData1();
//                    process.execute();
                }else if (menuItem.getText() == "Set Budget") {
                  //  startActivity(new Intent(Main2Activity.this, Main2Activity.class));

                }
            }

        });

    }


    public void GetDataFromEditText(){
    userEx = edEx.getText().toString();

}
    public void SendDataToServer(final String expense){
        class SendPostReqAsyncTask extends AsyncTask<String, Void, String> {
            @RequiresApi(api = Build.VERSION_CODES.N)
            @Override
            protected String doInBackground(String... params) {

                String exHolder = expense;

                List<NameValuePair> nameValuePair = new ArrayList<NameValuePair>();

                nameValuePair.add(new BasicNameValuePair("date", exHolder));

                try {
                    HttpClient httpClient = new DefaultHttpClient();

                    HttpPost httpPost = new HttpPost(dataUrl);

                    httpPost.setEntity(new UrlEncodedFormEntity(nameValuePair));

                    HttpResponse httpResponse = httpClient.execute(httpPost);

                    HttpEntity httpentity = httpResponse.getEntity();

                    //progressBar.setProgress(50);


                } catch (ClientProtocolException e) {

                } catch (IOException e) {

                }
                return "Data Submit Successfully";
            }

            @Override
            protected void onPostExecute(String result) {
                super.onPostExecute(result);

                Toast.makeText(Main2Activity.this, "Monthly Budget updated", Toast.LENGTH_LONG).show();


            }
        }
        SendPostReqAsyncTask sendPostReqAsyncTask = new SendPostReqAsyncTask();
        sendPostReqAsyncTask.execute(expense);
    }




    public class fetchDataEx extends AsyncTask<Void, Void, Void> {
        String data = "";

        @Override
        protected Void doInBackground(Void... voids) {

            try {
                URL url = new URL("http://fyp1718.onlinewebshop.net/php/employer/soccer.php");

                HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                InputStream inputStream = httpURLConnection.getInputStream();
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
                String line = "";
                while (line != null) {
                    line = bufferedReader.readLine();
                    data = data + line;
                }
                JSONArray jsonArray = new JSONArray(data);
                double Num = 0;
                double countP ;
                String textt = null;
                //List<PieEntry> pieEntries = new ArrayList<>();
                for (int x = 0; x < jsonArray.length(); x++) {

                    JSONObject jsonObject = jsonArray.getJSONObject(x);

                    String tExpense = jsonObject.getString("itemBoughtPrice");
                    //String iName = jsonObject.getString("itemId").trim();
                    // pieEntries.add(new PieEntry(Float.parseFloat(tExpense)));
                    // int toExpense = + jsonObject.getInt("totalExpense");


                    textt = textt + tExpense;

                    Num = Num + Double.parseDouble(tExpense);
                    double Num2 = Double.parseDouble(userEx);
                     countP = (Num2 - Num)/Num2 *100;
                    progressBar.setProgress(100-(int) countP);
                    totalSp.setText("           " +Double.toString(100- countP) + "%" + "\n" +"Current spending");
                    sumEx.setText("$" + Double.toString(Num));
                    //totalSp.setText(Double.toString(countP));


                }

                //totalSp.setText("asdasd");


            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            }

            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);


        }
    }
}
