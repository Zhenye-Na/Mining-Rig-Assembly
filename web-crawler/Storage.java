package newegg;
import java.io.*;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class Storage {

	public static void main(String[] args) throws IOException {
		
		Document d = Jsoup.parse(new File("C:\\Users\\noden\\Documents\\h11.html"), "UTF-8");
		Writer writer = new FileWriter("c:\\data\\Storage.txt", true);

		Element table = d.select("ul#category_content").first();
		Elements rows = table.select("li");
		
		for(Element row : rows) {
			Element namediv = row.select("div.title").first();
			Element pricediv = row.select("div.price").first();
			Element imagediv = row.select("div.image").first();
			
			if(pricediv != null && pricediv.text().contains("$")){
				String imageurl = imagediv.select("img").attr("src");
				if(imageurl.contains("http")){
					System.out.println(namediv.text());
					writer.write(namediv.text() + "\n");				
				
					Elements divlist = row.select("div");
					for(Element div : divlist) {
						if(div.text().toLowerCase().contains("cache") == false && (div.text().toLowerCase().contains("gb") || div.text().toLowerCase().contains("mb") || div.text().toLowerCase().contains("tb")))	{
							System.out.println("Storage: " + div.text());
							writer.write("Storage: " + div.text() + "\n");
						}

					}
					boolean test = false;
					for(Element div : divlist) {
						if(div.text().toLowerCase().contains("cache")){
							System.out.println("Cache: " + div.text());
							writer.write("Cache: " + div.text() + "\n");
							test = true;
						}
					}
					if(test == false) {
						System.out.println("Cache: " + "NULL");
						writer.write("Cache: " + "NULL" + "\n");
					}
					
					System.out.println("IsSSD: " + "No");
					writer.write("IsSSD: " + "No" + "\n");
					System.out.println(pricediv.text());
					writer.write(pricediv.text() + "\n");
					System.out.println(imageurl + "\n");
					writer.write(imageurl + "\n\n");
				}
				
				else if(imageurl.contains("no-image")){
					continue;
				}
				
				else {
					System.out.println(namediv.text());
					writer.write(namediv.text() + "\n");				
				
					Elements divlist = row.select("div");
					for(Element div : divlist) {
						if(div.text().toLowerCase().contains("cache") == false && (div.text().toLowerCase().contains("gb") || div.text().toLowerCase().contains("mb") || div.text().toLowerCase().contains("tb")))	{
							System.out.println("Storage: " + div.text());
							writer.write("Storage " + div.text() + "\n");
						}
					}
					
					boolean test = false;
					for(Element div : divlist) {
						if(div.text().toLowerCase().contains("cache")){
							System.out.println("Cache: " + div.text());
							writer.write("Cache: " + div.text() + "\n");
							test = true;
						}
					}
					if(test == false) {
						System.out.println("Cache: " + "NULL");
						writer.write("Cache: " + "NULL" + "\n");
					}
					System.out.println("IsSSD: " + "No");
					writer.write("IsSSD: " + "No" + "\n");
					System.out.println(pricediv.text());
					writer.write(pricediv.text() + "\n");
					System.out.println("http:" + imageurl + "\n");
					writer.write("http:" + imageurl + "\n\n");
				}	
			}
		}
		writer.close();
	}

}