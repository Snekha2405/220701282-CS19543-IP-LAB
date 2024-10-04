

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class view
 */
@WebServlet("/view")
public class view extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public view() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		response.setContentType("text/html");
		PrintWriter out = response.getWriter();
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");
	    	String URL = "jdbc:mysql://localhost:3306/lib";
	    	Connection conn = DriverManager.getConnection(URL,"root","");
	    	
	    	PreparedStatement ps=conn.prepareStatement("select * from books");
	    	
	    	ResultSet rs=ps.executeQuery();
	    	out.println("<table border=1>");
	    	out.println("<tr>");
	    	out.println("<th>Book Id</th>");
	    	out.println("<th>Book Name</th>");
	    	out.println("<th>Author</th>");
	    	out.println("<th>Publisher</th>");
	    	out.println("<th>Edition</th>");
	    	out.println("<th>Price</th><br>");
	    	out.println("</tr>");
	    	while(rs.next()) {
	    		
	    		
	    		out.println("<tr>");
	    		out.println("<td>"+rs.getInt(1)+"</td>");
	    		
	    		
	    		out.println("<td>"+rs.getString(2)+"</td>");
	    		
	    		out.println("<td>"+rs.getString(3)+"</td>");
	    		
	    		out.println("<td>"+rs.getString(4)+"</td>");
	    		
	    		out.println("<td>"+rs.getString(5)+"</td>");
	    		
	    		out.println("<td>"+rs.getString(6)+"</td>");
	    		
	    		
	    		out.println("</tr>");
	    		
	    	}
	    	out.println("</table>");
			}
			catch(Exception e){
				out.println(e);
			}
		
		
		// TODO Auto-generated method stub
		
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
