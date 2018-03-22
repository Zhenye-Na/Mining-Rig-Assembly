package newegg;
import java.io.IOException;
import java.io.*;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class PowerSupplyParser {

	public static void main(String[] args) throws IOException {
		
		Document d = Jsoup.connect("https://www.newegg.com/Power-Supplies/SubCategory/ID-58?Tid=7657").timeout(6000).get();
		Elements products = d.select("div.item-container  ");
		
		Writer writer = new FileWriter("c:\\data\\powersupply.xml", true);
		
		for (Element product : products) {
			String image_url = product.select("a.item-img img").attr("src");
			String product_name = product.select("a.item-title").text();
			Element link = product.select("a.item-title").get(0);
			String product_link = link.attr("abs:href");
			Elements price = product.select("li.price-current");
			
			Document c = Jsoup.connect(product_link).get();
			Element infodiv = c.select("div.plinks").first();
			Elements dts = infodiv.select("dt");
			Elements dds = infodiv.select("dd");
			int count = 0;
			
			System.out.println(product_name);
			System.out.println("$" + price.select("strong").text() + price.select("sup").text());
			writer.write("<PRODUCT>" + product_name + "</PRODUCT>" + "\n");
			writer.write("<PRICE>" + "$" + price.select("strong").text() + price.select("sup").text() + "</PRICE>" + "\n");

			for (Element powersupply : dts) {
					String str1 = powersupply.text();
					if(str1.toLowerCase().contains("type")){
						System.out.println(str1 + ": " + dds.get(count).text());
						writer.write("<FORMFACTOR>" + dds.get(count).text() + "</FORMFACTOR>" + "\n");
						break;
					}
					
					else {
						count = count + 1;
					}
					
					if(count == dts.size()) {
						System.out.println("TYPE" + ": NULL");
						writer.write("<FORMFACTOR>" + "NULL" + "</FORMFACTOR>" + "\n");
					}
			}
			
			count = 0;
			
			for (Element powerrating : dts) {
				String str1 = powerrating.text();
				if(str1.toLowerCase().contains("maximum")){
					System.out.println(str1 + ": " + dds.get(count).text());
					writer.write("<POWERRATING>" + dds.get(count).text() + "</POWERRATING>" + "\n");
					break;
				}
				
				else {
					count = count + 1;
				}
				
				if(count == dts.size()) {
					System.out.println(str1 + ": NULL");
					writer.write("<POWERRATING>" + "NULL" + "</POWERRATING>" + "\n");
				}
			}
			
			count = 0;
			
			for (Element certification : dts) {
				String str1 = certification.text();
				if(str1.toLowerCase().contains("efficient")){
					System.out.println(str1 + ": " + dds.get(count).text());
					writer.write("<CERTIFICATION>" + dds.get(count).text() + "</CERTIFICATION>" + "\n");
					break;
				}
				
				else {
					count = count + 1;
				}
			}
			
			System.out.println("http:" + image_url + "\n");
			writer.write("<IMAGE>" + "http:" + image_url + "</IMAGE>" + "\n" + "\n");
		}		
		writer.close();
	}
}
