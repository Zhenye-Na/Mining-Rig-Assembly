package newegg;
import java.io.IOException;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class NeweggParser {

	public static void main(String[] args) throws IOException {
		
		Document d = Jsoup.connect("https://www.newegg.com/LCD-LED-Monitors/SubCategory/ID-20?Tid=160979").timeout(6000).get();
		Elements products = d.select("div.item-container  ");
		for (Element product : products) {
			String image_url = product.select("a.item-img img").attr("src");
			String product_name = product.select("a.item-title").text();
			Elements price = product.select("li.price-current");
			
			System.out.println(product_name);
			System.out.println("$" + price.select("strong").text() + price.select("sup").text());
			System.out.println("http:" + image_url + "\n");

			
		}

	}

}
