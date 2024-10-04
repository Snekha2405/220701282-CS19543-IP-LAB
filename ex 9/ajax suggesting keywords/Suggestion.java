import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
@WebServlet("/Suggestion")
public class Suggestion extends HttpServlet {
    private static final long serialVersionUID = 1L;
    private String[] students = {"John", "Jane", "James", "Jennifer", "Jack", "Julia", "Jacob","Snekha", "Swetha", "Sneha", "Shiny", "Hariharan", "Prasanth", "Varun", "Tharun", "Lakshitha", "Rahul", "Bhuvaneswari", "Monica"};
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String query = request.getParameter("b").toLowerCase();
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        for (String student : students) {
            if (student.toLowerCase().startsWith(query)) {
                out.println("<p>" + student + "</p>");
            }
        }
    }
}
