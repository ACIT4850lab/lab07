<div class="row">
    <h2>Bookings</h2>
    
    <form id="welcome" name="welcome" action="welcome/search" method="post">
        Search bookings:
        <select id="ddDay" name="ddDay">                      
            {ddDayOptions}
                <option value="{value}">{value}</option>
            {/ddDayOptions}
        </select>
        <select id="ddTime" name="ddTime">                      
            {ddTimeOptions}
                <option value="{value}">{option}</option>
            {/ddTimeOptions}
        </select>   
        <input class="abutton" type="submit" name="Search" value="Search" />
    </form>
    
    
    {bookings}
    <p><a href="/welcome/{filename}/{filename}">{filename}</a></p>
    {/bookings}
    
    <p>Select an booking above to see a facet.</p>
        
</div>