package com.example.aaddr.test03;

import android.os.AsyncTask;

import com.github.mikephil.charting.charts.PieChart;
import com.github.mikephil.charting.data.PieData;
import com.github.mikephil.charting.data.PieDataSet;
import com.github.mikephil.charting.data.PieEntry;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.JarURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by aaddr on 17/2/2018.
 */

//public class fetchData extends AsyncTask<Void, Void, Void> {
//    String data = "";
//    String dataParsed = "";
//    String singleParsed = "";
//
//    @Override
//    protected Void doInBackground(Void... voids) {
//
//        try {
//            URL url = new URL("http://10.0.2.2:8080/soccer.php");
//
//            HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
//            InputStream inputStream = httpURLConnection.getInputStream();
//            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
//            String line ="";
//            while(line != null) {
//                line = bufferedReader.readLine();
//                data = data + line;
//            }
//
//            JSONArray JA = new JSONArray(data);
//            for (int i = 0; i<JA.length(); i++) {
//                JSONObject JO = (JSONObject) JA.get(i);
//                singleParsed = "Employer ID:" + JO.get("employerId") + "\n" +
//                        "Item:" + JO.get("item") + "\n" +
//                        "Tatal Expense:" + JO.get("totalExpense") + "\n" +
//                        "Item ID:" + JO.get("itemId") + "\n" ;
//
//                dataParsed = dataParsed + singleParsed + "\n";
//
//
////                //test
////                List<PieEntry> pieEntries = new ArrayList<>();
////                for (int j = 0; j<JA.length(); j++ ) {
////                    pieEntries.add(new PieEntry((Float) JO.get("employerId"), JO.get("username")));
////
////
////                }
////                PieDataSet dataSet =  new PieDataSet(pieEntries, "Test:");
////                PieData pdata = new PieData(dataSet);
////                //PieChart chart = (PieChart) findViewById(R.id.chart);
////                MonthlyReport.
//
//            }
//
//        } catch (MalformedURLException e) {
//            e.printStackTrace();
//        } catch (IOException e) {
//            e.printStackTrace();
//        } catch (JSONException e) {
//            e.printStackTrace();
//        }
//
//        return null;
//    }
//
//    @Override
//    protected void onPostExecute(Void aVoid) {
//        super.onPostExecute(aVoid);
//
//        MonthlyReport.data.setText(this.dataParsed);
//        //MonthlyReport.chart
//
//    }
//}
