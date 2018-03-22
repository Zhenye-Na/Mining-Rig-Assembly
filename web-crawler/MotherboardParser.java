package newegg;
import java.io.IOException;
import java.io.*;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class MotherboardParser {

	public static void main(String[] args) throws IOException {
		
		Document d = Jsoup.connect("https://www.newegg.com/Product/ProductList.aspx?Submit=StoreIM&Depa=1&Category=20").timeout(6000).get();
		Elements products = d.select("div.item-container  ");
		
		Writer writer = new FileWriter("c:\\data\\motherboard1.xml", false);
		
		for (Element product : products) {
			String image_url = product.select("a.item-img img").attr("src");
			String product_name = product.select("a.item-title").text();
			Element link = product.select("a.item-title").get(0);
			String product_link = link.attr("abs:href");
			Elements price = product.select("li.price-current");
			
			Document c = Jsoup.connect(product_link).get();
			Element formfactordiv = c.select("div.plinks").first();
			Elements dts = formfactordiv.select("dt");
			Elements dds = formfactordiv.select("dd");
			int count = 0;
			
			System.out.println(product_name);
			System.out.println("$" + price.select("strong").text() + price.select("sup").text());
			writer.write(product_name + "\n");
			writer.write("$" + price.select("strong").text() + price.select("sup").text() + "\n");

			for (Element formfactor : dts) {
					String str1 = formfactor.text();
					if(str1.toLowerCase().contains("form")){
						System.out.println(str1 + ": " + dds.get(count).text());
						writer.write(str1 + ": " + dds.get(count).text() + "\n");
						break;
					}
					
					else {
						count = count + 1;
					}
			}
			System.out.println("http:" + image_url + "\n");
			writer.write("http:" + image_url + "\n" + "\n");
		}		
		writer.close();
	}
}
