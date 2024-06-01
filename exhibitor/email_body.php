<?php

function getEmailBody ()
{
    return
        '<p>Dear ' . $_POST["name"] . ' ' . $_POST["sur_name"] . '</p></br>'
        . '<h3><u>Reference: UKBCCI Trade show and business networking event</u></h3>'
        . '<p>Thank you for kindly accepting our invitation to attend the UKBCCI trade show and business networking , to be held Monday 8th January 2024. </br> As we develop young entrepreneurs, our goal is to become a model for supporting both the current and future expansion of trade and industry in both nations.</br> The event is to bring together the business community from within the locality, to meet and network and to host a trade show for young British Bangladeshi entrepreneurs who have diversified into the many different sectors.</p>'

        . '<p> The event will be hosted at <b>Yasmin Banqueting, 1 Intown Row, Walsall, WS1 2AD </b>.</p>'
        . '<p>The programme is scheduled to start from 6.00pm followed by dinner. </p>'
        . '<p>As an exhibitor it would make your business standout at the show if you have pop up banners to put behind your table and business cards and leaflets to hand out to prospective clients. If you have any products also that would be good.The cost of one stall is £150.00 only. This is merely to cover costs.</p>'
        . '<p>Please provide payment using the link below:</p>'
        . '<p style="line-height:4px;">UKBCCI Ltd</p>'
        . '<p style="line-height:4px;">Barclays Bank</p>'
        . '<p style="line-height:4px;">Sort code: 20-41-50</p>'
        . '<p style="line-height:4px;">A/c no: 93909972</p>'
        . '<p style="line-height:4px;">Ref:' . $_POST["business_name"] . '</p> </br></br>'
        . '<p >We look forward to seeing you on the day.</p> </br>'
        . '<p>The non-profit UK Bangladesh Catalysts of Commerce and Industry (UKBCCI) works to support the UK business community and advance bilateral trade between the UK and Bangladesh.</p>'
     
        . '<p style=""><b>Kind Regards</b></p>'
        . ' <div id="mail"> <p style="line-height:1px;">Imam Ahmad</p>'
        . '<p style="line-height:5px;">President</p>'
        . '<p style="line-height:5px;">Midlands Region</p>'
        . ' <img width=220 height=150 id="1" src="https://elipos.com/ukbcci/assets/images/image001.jpg">'
        . '<p style="line-height:5px;">UK Bangladesh Catalysts of Commerce & Industry</p>'
        . '<p style="line-height:5px;">Unit- S1, The Montefiore Centre</p>'
        . '<p style="line-height:5px;">Hanbury Street</p>'
        . '<p style="line-height:5px;">London E1 5HZ</p>'
        . '<p style="line-height:5px;">Head Office: 0207 247 2331</p>'
        . '<p style="line-height:5px;">Direct Line: 01922 721496</p>'
        . '<p style="line-height:5px;">Mobile: 07956800849</p>'
        . '<p style="line-height:5px;">e:<a style="" href="i.ahmad@ukbccimidlands.org">i.ahmad@ukbccimidlands.org</a></p>'
        . '<p style="line-height:5px;">W:<a style="" href="www.ukbcci.org.uk">www.ukbcci.org.uk</a></p>'
        . '<p style="line-height:5px;"><a style="" href="www.ukbccibusinessawards.co.uk">www.ukbccibusinessawards.co.uk</a></p> </div>'
        . '<p style="line-height:5px;"> --------------------------------------------------------------------</p>'
        . '<h6 style="line-height:1px;"> UKBCCI is registered in England and Wales, registered number is 09909108. </h6>'

        . '<h6>The content of this message and attached file are confidential and/or privileged and are for the intended recipient only. If you are not the intended recipient, any unauthorised review, use, re-transmission, dissemination, copying, disclosure or other use of, or taking of any action in reliance upon this information is strictly prohibited.If you receive this message in error, please contact the sender immediately and then delete the e-mail from your system. Copyright in this e-mail and attachments created by us, belong to UKBCCI Ltd. Any attachments with this message should be checked for viruses before it is opened. UKBCCI cannot be held responsible for any failure by the recipient to test for viruses before opening any attachments. Should you communicate with anyone at UKBCCI you consent to us monitoring and reading any such correspondence.</h6>';
}

