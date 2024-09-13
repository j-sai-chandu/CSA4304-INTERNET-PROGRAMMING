import java.io.IOException; import java.io.PrintWriter;
import javax.servlet.ServletException; import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest; import javax.servlet.http.HttpServletResponse;
public class RegistrationServletTwo extends HttpServlet
{
public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException
23
{
String name = request.getParameter("name");
String password = request.getParameter("password"); String profession = request.getParameter("profession"); String email = request.getParameter("email");
String cell = request.getParameter("cell"); response.setContentType("text/html"); PrintWriter out = response.getWriter(); out.println("<html><body bgcolor = wheat>"); out.println("<center>");
out.println("<h1>REGISTRATION SUCCESSFUL ......... </h1>");
out.println("</center>"); out.println("</body></html>"); out.close();
}