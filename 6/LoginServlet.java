package shopping; import java.io.*; import javax.servlet.*;
import javax.servlet.http.*;
public class LoginServlet extends HttpServlet
{
protected void doPost(HttpServletRequest req, HttpServletResponse res) throws ServletException,IOException
31
{
res.setContentType("text/html"); PrintWriter out=res.getWriter(); String usr=req.getParameter("User");
String pwd=req.getParameter("password"); String card=req.getParameter("CardID");
boolean flag=true;
String[] userID=getInitParameter("usernames").split(","); String[] password=getInitParameter("passwords").split(","); String[] cardids=getInitParameter("cardIDs").split(",");
int i; for(i=0;i<userID.length;i++)
{
if(userID[i].equals(usr) && password[i].equals(pwd)&&cardids[i].equals(card))
{
flag=false;
Cookie cookie1=new Cookie("CurrentUser",usr); Cookie cookie2=new Cookie("CreditCard",card); res.addCookie(cookie1); res.addCookie(cookie2); out.println("<h2>Welcome "+usr+"</h2><hr>");
out.println("<h2>Select the book you would like to purchase<h2><hr>"); out.println("<form action='LoginSuccess'>");
out.println("<input type=radio name='book' checked value='Let us C'/>Let us C<br>");
out.println("<input type=radio name='book' value='Exploring Python'/>Exploring Python<br>");
out.println("<input type=radio name='book' value='Mastering C'/>Mastering C<br>"); out.println("<input type=submit value='purchase'><hr>");
}
}
if(flag==true)
{
out.println("<h4>Invalid user name or password or card number,please try again by clicking following link</h4>");
out.println("<a href='LoginForm.html'>"+"LoginForm.html");
}
}
}