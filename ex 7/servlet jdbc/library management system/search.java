

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
 * Servlet implementation class search
 */
@WebServlet(name = "insert", urlPatterns = { "/insert" })
public class search extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public search() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException{
		response.setContentType("text/html");
		PrintWriter out = response.getWriter();
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");
	    	String URL = "jdbc:mysql://localhost:3306/lib";
	    	Connection conn = DriverManager.getConnection(URL,"root","");
	    	
	    	PreparedStatement ps=conn.prepareStatement("select * from books where book_id=?");
	    	Integer b_id=Integer.parseInt(request.getParameter("n1"));
	    	ps.setInt(1, b_id);
	    	ResultSet rs=ps.executeQuery();
	    	if(rs.next()) {
	    		out.println("<table border=1>");
	    		out.println("<tr>");
	    		out.println("<td>Book id:</td>");
	    		out.println("<td>"+rs.getInt(1)+"</td>");
	    		out.println("</tr>");
	    		out.println("<tr>");
	    		out.println("<td>Book Name:</td>");
	    		out.println("<td>"+rs.getString(2)+"</td>");
	    		out.println("</tr>");
	    		out.println("<tr>");
	    		out.println("<td>Author:</td>");
	    		out.println("<td>"+rs.getString(3)+"</td>");
	    		out.println("</tr>");
	    		out.println("<tr>");
	    		out.println("<td>Publisher:</td>");
	    		out.println("<td>"+rs.getString(4)+"</td>");
	    		out.println("</tr>");
	    		out.println("<tr>");
	    		out.println("<td>Edition:</td>");
	    		out.println("<td>"+rs.getString(5)+"</td>");
	    		out.println("</tr>");
	    		out.println("<tr>");
	    		out.println("<td>Price:</td>");
	    		out.println("<td>"+rs.getString(6)+"</td>");
	    		out.println("</tr>");
	    		out.println("</table>");
	    		
	    	}
			}
			catch(Exception e){
				out.println(e);
			}
	}
		// TODO Auto-generated method stub
		

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
