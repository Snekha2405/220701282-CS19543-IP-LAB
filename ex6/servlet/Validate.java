import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Course
 */
@WebServlet("/Validate")
public class Validate extends HttpServlet {
	private static final long serialVersionUID = 1L;

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		response.setContentType("text/html");
        java.io.PrintWriter out = response.getWriter();
        
        String studentName = request.getParameter("n1");
        String rollNo = request.getParameter("n2");
        String gender = request.getParameter("n4");
        String year = request.getParameter("n5");
        String department = request.getParameter("n6");
        String section = request.getParameter("n7");
        String mobileNo = request.getParameter("n8");
        String emailId = request.getParameter("n3");
        String address = request.getParameter("n9");
        String city = request.getParameter("n10");
        String country = request.getParameter("n11");
        String pincode = request.getParameter("n12");

        out.println("<html><body>");
        out.println("<h1>Registration Details</h1>");
        out.println("<p><strong>Student Name:</strong> " + studentName + "</p>");
        out.println("<p><strong>Roll Number:</strong> " + rollNo + "</p>");
        out.println("<p><strong>Gender:</strong> " + gender + "</p>");
        out.println("<p><strong>Year:</strong> " + year + "</p>");
        out.println("<p><strong>Department:</strong> " + department + "</p>");
        out.println("<p><strong>Section:</strong> " + section + "</p>");
        out.println("<p><strong>Mobile Number:</strong> " + mobileNo + "</p>");
        out.println("<p><strong>E-Mail ID:</strong> " + emailId + "</p>");
        out.println("<p><strong>Address:</strong> " + address + "</p>");
        out.println("<p><strong>City:</strong> " + city + "</p>");
        out.println("<p><strong>Country:</strong> " + country + "</p>");
        out.println("<p><strong>Pincode:</strong> " + pincode + "</p>");
        out.println("</body></html>");
    }
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		doGet(request,response);
	}
}
