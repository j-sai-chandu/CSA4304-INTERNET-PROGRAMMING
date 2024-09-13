package shopping; import java.io.*; import javax.servlet.*;
import javax.servlet.http.*;
public class LoginSuccess extends HttpServlet
{
32
protected void doGet(HttpServletRequest req,HttpServletResponse res) throws ServletException,IOException
{
Cookie[] mycookie=req.getCookies(); res.setContentType("text/html"); PrintWriter out=res.getWriter();
String book=req.getParameter("book");
out.print("<h2>welcome "+mycookie[0].getValue()+"</h2><hr>"); out.print("<h3>Thank you for purchasing book:"+book+"</h3><hr>"); out.print("<h3>Rs.250 debited from credit card: "+mycookie[1].getValue()); out.close();
}
}