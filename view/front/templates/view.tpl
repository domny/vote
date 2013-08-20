{include file="../../includes/header.tpl"}

<table>
    <tr>
        <td>
            <div class="voteForm">
                <p>你最喜欢的水果</p>
                <br>
                <br>

                <form action="/view/front/report.php" method="post">
                    <input type="radio" name="fruit" value="1-apple">apple<br>
                    <input type="radio" name="fruit" value="2-pear">pear<br>
                     <input type="radio" name="fruit" value="3-banana">banana<br>
                    <input type="submit" value="submit">
                </form>

            </div>
        </td>
    </tr>

    <tr>
        <td>
            <input class="appDomin" type="hidden" value="{$myDomain}"/>
            <div class="report"></div>
            <button class="viewreport">查看报告</button>
        </td>
    </tr>

    <tr>
        <td>
            <input class="topinput" type="text" value=""/>
            <div class="topoutput"></div>
            <button class="topbtn">top get shop api</button>
        </td>
    </tr>

</table>

<a href="/assets/images/test.png"><img src="/assets/images/test.png" /></a>
<script src="/assets/javascripts/exchange.js"></script>
{include file="../../includes/footer.tpl"}



