package newegg;
import java.io.*;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class MemoryParser {

	public static void main(String[] args) throws IOException {
		
		Document d = Jsoup.connect("https://www.newegg.com/Desktop-Memory/SubCategory/ID-147?cm_sp=CAT_Memory_1-_-VisNav-_-Desktop-Memory&PageSize=96").timeout(6000).get();
		Elements products = d.select("div.item-container  ");
		String dtext = d.text();
		System.out.println(dtext);
		Writer writer = new FileWriter("c:\\data\\memory2.xml", true);
		
		for (Element product : products) {
			String image_url = product.select("a.item-img img").attr("src");
			String product_name = product.select("a.item-title").text();
			Element link = product.select("a.item-title").get(0);
			String product_link = link.attr("abs:href");
			Elements price = product.select("li.price-current");
			Document c = Jsoup.connect(product_link).get();
			Element capacitydiv = c.select("div.plinks").first();
			Elements dts = capacitydiv.select("dt");
			Elements dds = capacitydiv.select("dd");
			int count = 0;
			
			System.out.println(product_name);
			System.out.println("$" + price.select("strong").text() + price.select("sup").text());
			writer.write("<PRODUCT>" + product_name + "</PRODUCT>" + "\n");
			writer.write("<PRICE>" +"$" + price.select("strong").text() + price.select("sup").text() + "</PRICE>" + "\n");

			for (Element capacity : dts) {
				String str1 = capacity.text();
				if(str1.toLowerCase().contains("capacity")){
					System.out.println(str1 + ": " + dds.get(count).text());
					writer.write("<CAPACITY>" + dds.get(count).text() + "</CAPACITY>" + "\n");
					break;
				}
				
				else {
					count = count + 1;
				}
			}
			System.out.println("http:" + image_url + "\n");
			writer.write("<IMAGE>" + "http:" + image_url + "</IMAGE>" + "\n" + "\n");
			try {
			    Thread.sleep(1000);
			} catch(InterruptedException ex) {
			    Thread.currentThread().interrupt();
			}
		}
		writer.close();

	}

}
