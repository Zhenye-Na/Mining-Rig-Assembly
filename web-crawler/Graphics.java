package newegg;
import java.io.*;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

public class Graphics {

	public static void main(String[] args) throws IOException {
		
		Document d = Jsoup.parse(new File("C:\\Users\\noden\\Documents\\g32.html"), "UTF-8");
		Writer writer = new FileWriter("c:\\data\\Graphics.txt", true);

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
					boolean test1 = false;
					for(Element div : divlist) {
						if(div.text().toLowerCase().contains("chipset"))	{
							System.out.println("Chipset: " + div.text());
							writer.write("Chipset: " + div.text() + "\n");
							test1 = true;
						}
					}
					if(test1 == false) {
						System.out.println("Chipset: " + "NULL");
						writer.write("Chipset: " + "NULL" + "\n");
					}
					boolean test2 = false;
					for(Element div : divlist) {
						if(div.text().toLowerCase().contains("gb") || div.text().toLowerCase().contains("mb") || div.text().toLowerCase().contains("tb"))	{
							System.out.println("Memory: " + div.text());
							writer.write("Memory: " + div.text() + "\n");
							test2 = true;
						}
					}
					if(test2 == false) {
						System.out.println("Memory: " + "NULL");
						writer.write("Memory: " + "NULL" + "\n");
					}
					boolean test3 = false;
					for(Element div : divlist) {
						if(div.text().toLowerCase().contains("clock"))	{
							System.out.println("Core Clock: " + div.text());
							writer.write("Core Clock: " + div.text() + "\n");
							test3 = true;
						}
					}
					if(test3 == false) {
						System.out.println("Core Clock: " + "NULL");
						writer.write("Core Clock: " + "NULL" + "\n");
					}
					
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
					boolean test1 = false;
					for(Element div : divlist) {
						if(div.text().toLowerCase().contains("chipset"))	{
							System.out.println("Chipset: " + div.text());
							writer.write("Chipset: " + div.text() + "\n");
							test1 = true;
						}
					}
					if(test1 == false) {
						System.out.println("Chipset: " + "NULL");
						writer.write("Chipset: " + "NULL" + "\n");
					}
					boolean test2 = false;
					for(Element div : divlist) {
						if(div.text().toLowerCase().contains("gb") || div.text().toLowerCase().contains("mb") || div.text().toLowerCase().contains("tb"))	{
							System.out.println("Memory: " + div.text());
							writer.write("Memory: " + div.text() + "\n");
							test2 = true;
						}
					}
					if(test2 == false) {
						System.out.println("Memory: " + "NULL");
						writer.write("Memory: " + "NULL" + "\n");
					}
					boolean test3 = false;
					for(Element div : divlist) {
						if(div.text().toLowerCase().contains("clock"))	{
							System.out.println("Core Clock: " + div.text());
							writer.write("Core Clock: " + div.text() + "\n");
							test3 = true;
						}
					}
					if(test3 == false) {
						System.out.println("Core Clock: " + "NULL");
						writer.write("Core Clock: " + "NULL" + "\n");
					}
					
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