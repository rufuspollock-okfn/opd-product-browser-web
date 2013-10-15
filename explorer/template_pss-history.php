<h1>PSS Specification History</h1>

<hr/>
<span style="font-size:18px"><strong>PSS 0.01 Specification</strong></span>
<hr/>

<h2>What is PSS?<a name="whatIsPss"></a></h2>

<p>PSS is a Web content syndication format.</p>

<p>Its name is an acronym for <i><b>P</b>roduct <b>S</b>imple <b>S</b>yndication.</i></p>

<p>PSS is a dialect of XML. All PSS files must conform to the XML 1.0 <a href="http://www.w3.org/TR/REC-xml" target="_blank">specification</a>, as published on the World Wide Web Consortium (W3C) website.</p>

<p>A summary of <a href="http://www.product-open-data.com/pss-history" target="_blank">PSS version history</a>.</p>

<p>At the top level, a PSS document is a &lt;pss&gt; element, with a mandatory attribute called version, that specifies the version of PSS that the document conforms to. If it conforms to this specification, the version attribute must be 0.01.</p>

<p>Subordinate to the &lt;pss&gt; element is a single &lt;manufacturer&gt; element, which contains information about the manufacturer (metadata) and its products.</p>

<h2>Sample files<a name="sampleFiles"></a></h2>

<p>Here are sample files for: PSS <a href="http://www.product-open-data.com/docs/pss-sample-001.xml" target="_blank">0.01</a>.</p>

<h2>About this document<a name="aboutThisDocument"></a></h2>

<p>This document represents the current status of PSS and use as a template the structure of the RSS 2.11 specification. Change notes are <a href="http://www.product-open-data.com/pss-change-notes" target="_blank">here</a>.</p>

<p>First we document the required and optional sub-elements of &lt;manufacturer&gt;; and then document the sub-elements of &lt;brand&gt; and &lt;item&gt;. The final sections answer frequently asked questions, and provide a roadmap for future evolution, and guidelines for extending PSS.</p>

<p>The <a href="http://www.product-open-data.com/pss-profile" target="_blank">PSS Profile</a> contains a set of recommendations for how to create PSS documents that work best in the wide and diverse audience of client software that supports the format.</p>

<p>PSS documents can be tested for validity in the <a href="http://feedvalidator.org/" target="_blank">PSS Validator</a>.</p>

<h2>Required manufacturer elements<a name="requiredChannelElements"></a></h2>

<p>Here's a list of the required manufacturer elements, each with a brief description, an example, and where available, a pointer to a more complete description.</p>

<table cellspacing="3" cellpadding="5">
<tr valign="top"><th width="100px">Element</tdh><th width="300px">Description</th><th width="200px">Example</th></tr>
<tr valign="top">
  <td><span class="element">name</span></td>
  <td>The name of the manufacturer.</td><td class="examplecell">Beverage Alpha</td></tr>
<tr valign="top"><td><span class="element">link</span></td>
<td>The URL to the manufacturer official HTML website</td><td class="examplecell">http://www.b-alpha.com/</td></tr>
<tr valign="top"><td><span class="element">description</span></td>
<td>Phrase or sentence describing the activity of the manufacturer.</td>
<td class="examplecell">Fruit juice producer.</td></tr>
</table>

<h2>Optional manufacturer elements<a name="optionalManufacturerElements"></a></h2>

<p>Here's a list of optional manufacturer elements.</p>

<table cellspacing="3" cellpadding="5">
<tr valign="top"><th width="100px">Element</tdh><th width="300px">Description</th><th width="200px">Example</th></tr>
<tr valign="top"><td><span class="element">language</span></td><td>The language the manufacturer is written in. This allows aggregators to group all Italian language sites, for example, on a single page. A list of allowable values for this element, as provided by Netscape, is <a href="http://www.rssboard.org/rss-language-codes" target="_blank">here</a>. </td><td class="examplecell">en-us</td></tr>
<tr valign="top"><td><span class="element">copyright</span></td>
<td>Copyright notice for content in the feed.</td>
<td class="examplecell">Copyright 2013, Beverage  Alpha</td></tr>
<tr valign="top"><td><span class="element">managingEditor</span></td><td>Email address for person responsible for editorial content.</td><td class="examplecell">jacob@beverage-alpha.com (Jacob Marley)</td></tr>
<tr valign="top"><td><span class="element">webMaster</span></td>
<td>Email address for person responsible for technical issues relating to feed.</td><td class="examplecell">robert@beverage-alpha.com (Robert Marley)</td></tr>
<tr valign="top"><td><span class="element">pubDate</span></td>
<td>The publication date for the content in the feed. All date-times in RSS conform to the Date and Time Specification of <a href="http://asg.web.cmu.edu/rfc/rfc822.html" target="_blank">RFC 822</a>, with the exception that the year may be expressed with two characters or four characters (four preferred).</td><td class="examplecell">Sun, 15 Oct 2013 16:52:00 GMT</td></tr>
<tr valign="top"><td><span class="element">lastBuildDate</span></td>
<td>The last time the content of the feed changed.</td><td class="examplecell">Sun, 15 Oct 2013 17:35:23 GMT</td></tr>
<tr valign="top"><td><span class="element">category</span></td><td>Specify one or more categories that the manufacturer belongs to. Follows the same rules as the &lt;item&gt;-level <a href="pss-specification#ltcategorygtSubelementOfLtitemgt">category</a> element. More <a href="pss-specification#syndic8">info</a>.</td><td class="examplecell">&lt;category&gt;Newspapers&lt;/category></td></tr>
<tr valign="top"><td><span class="element">generator</span></td>
<td>A string indicating the program used to generate the feed.</td><td class="examplecell">MightyInHouse Content System v2.3</td></tr>
<tr valign="top"><td><span class="element">docs</span></td>
<td>A URL that points to the <a href="http://www.product-open-data.com/pss-specification" target="_blank">documentation</a> for the format used in the PSS file. It's probably a pointer to this page. It's for people who might stumble across an PSS file on a Web server 25 years from now and wonder what it is.</td>
<td class="examplecell">http://www.product-open-data.com/pss-specification</td></tr>
<tr valign="top"><td><span class="element">ttl</span></td><td>ttl stands for time to live. It's a number of minutes that indicates how long a manufacturer can be cached before refreshing from the source. More info <a href="pss-specification#ltttlgtSubelementOfLtchannelgt">here</a>.</td><td class="examplecell">&lt;ttl&gt;60&lt;/ttl&gt;</td></tr>
<tr valign="top"><td><span class="element">image</span></td>
<td>Specifies a GIF, JPEG or PNG image representing the manufactuer's logo that can be displayed. More info <a href="pss-specification#ltimagegtSubelementOfLtchannelgt">here</a>.</td><td></td></tr>
<tr valign="top"><td><span class="element">rating</span></td>
<td>The <a href="http://www.w3.org/PICS/">PICS</a> rating for the feedr.</td><td></td></tr>
<tr valign="top"><td><span class="element">textInput</span></td><td>Specifies a text input box that can be displayed with the manufacturer. More info <a href="pss-specification#lttextinputgtSubelementOfLtchannelgt">here</a>.</td><td></td></tr>
<tr valign="top"><td><span class="element">skipHours</span></td>
<td>A hint for aggregators telling them which hours they can skip. This element contains up to 24 &lt;hour&gt; sub-elements whose value is a number between 0 and 23, representing a time in GMT, when aggregators, if they support the feature, may not read the feed on hours listed in the &lt;skipHours&gt; element. The hour beginning at midnight is hour zero.</td><td></td></tr>
<tr valign="top"><td><span class="element">skipDays</span></td>
<td>A hint for aggregators telling them which days they can skip. This element contains up to seven &lt;day&gt; sub-elements whose value is Monday, Tuesday, Wednesday, Thursday, Friday, Saturday or Sunday. Aggregators may not read the feed during days listed in the &lt;skipDays&gt; element.</td><td></td></tr>
</table>

<h3>&lt;image&gt; sub-element of &lt;manufacturer&gt;<a name="ltimagegtSubelementOfLtchannelgt"></a></h3>

<p>&lt;image&gt; is an optional sub-element of &lt;manufacturer&gt;, which contains three required and three optional sub-elements.</p>

<p>&lt;url&gt; is the URL of a GIF, JPEG or PNG image that represents the manufacturer's logo.</p>

<p>&lt;title&gt; describes the image, it's used in the ALT attribute of the HTML &lt;img&gt; tag when the manufacturer is rendered in HTML.</p>

<p>&lt;link&gt; is the URL of the site, when the feed is rendered, the image is a link to the site. (Note, in practice the image &lt;title&gt; and &lt;link&gt; should have the same value as the manufacturer's &lt;title&gt; and &lt;link&gt;.</p>

<p>Optional elements include &lt;width&gt; and &lt;height&gt;, numbers, indicating the width and height of the image in pixels. &lt;description&gt; contains text that is included in the TITLE attribute of the link formed around the image in the HTML rendering.</p>

<p>Maximum value for width is 144, default value is 88.</p>

<p>Maximum value for height is 400, default value is 31.</p>

<h3>&lt;ttl&gt; sub-element of &lt;manufacturer&gt;<a name="ltttlgtSubelementOfLtchannelgt"></a> </h3>

<p>&lt;ttl&gt; is an optional sub-element of &lt;manufacturer&gt;.</p>

<p>ttl stands for time to live. It's a number of minutes that indicates how long a feed can be cached before refreshing from the source. This makes it possible for RSS sources to be managed by a file-sharing network such as Gnutella.</p>

<p>Example:</p>

<p class="example">&lt;ttl&gt;60&lt;/ttl&gt;</p>

<h3>&lt;textInput&gt; sub-element of &lt;manufacturer&gt;<a name="lttextinputgtSubelementOfLtchannelgt"></a></h3>

<p>A manufacturer may optionally contain a &lt;textInput&gt; sub-element, which contains four required sub-elements.</p>

<p>&lt;title&gt; -- The label of the Submit button in the text input area.</p>

<p>&lt;description&gt; -- Explains the text input area.</p>

<p>&lt;name&gt; -- The name of the text object in the text input area.</p>

<p>&lt;link&gt; -- The URL of the CGI script that processes text input requests.</p>

<p>The purpose of the &lt;textInput&gt; element is something of a mystery. You can use it to specify a search engine box. Or to allow a reader to provide feedback. Most aggregators ignore it.</p>


<h2>Requiered brand's elements<a name="requiredBrandElements"></a></h2>

<p>A manufacturer may contain any number of &lt;brand&gt;s. The difference between a product line and a brand has to be defined by the manufacturer; </p>

<p>Here's a list of requiered brand elements.</p>

<table cellspacing="3" cellpadding="5">
<tr valign="top"><th width="100px">Element</tdh><th width="300px">Description</th><th width="200px">Example</th></tr>
<tr valign="top"><td><span class="element">name</span></td>
  <td>Name of the brand.</td>
  <td class="examplecell">Super Juice</td></tr>
</table>

<h2>Optional brand's elements<a name="requiredBrandElements"></a></h2>

<p>Here's a list of optional brand elements.</p>

<table cellspacing="3" cellpadding="5" width="100%">
<tr valign="top"><th width="100px">Element</tdh><th width="300px">Description</th><th width="200px">Example</th></tr>
<tr valign="top">
  <td><span class="element">description</span></td>
  <td>Phrase or sentence describing the activity of the manufacturer.</td>
  <td class="examplecell">Fruit juice producer.</td>
</tr>
<tr valign="top">
  <td><span class="element">image</span></td>
  <td>Specifies a GIF, JPEG or PNG image representing the manufactuer's logo that can be displayed. More info <a href="pss-specification#ltimagegtSubelementOfLtchannelgt">here</a>.</td>
  <td></td>
</tr>
</table>

<h3>&lt;image&gt; sub-element of &lt;brand&gt;<a name="ltimagegtSubelementOfLtbrandgt"></a></h3>

<p>&lt;image&gt; is an optional sub-element of &lt;manufacturer&gt;, which contains three required and three optional sub-elements.</p>

<p>&lt;url&gt; is the URL of a GIF, JPEG or PNG image that represents the brand's logo.</p>

<p>&lt;title&gt; describes the image, it's used in the ALT attribute of the HTML &lt;img&gt; tag when the brand is rendered in HTML.</p>

<p>&lt;link&gt; is the URL of the site, when the feed is rendered, the image is a link to the site. (Note, in practice the image &lt;title&gt; and &lt;link&gt; should have the same value as the brand's &lt;title&gt; and &lt;link&gt;.</p>

<p>Optional elements include &lt;width&gt; and &lt;height&gt;, numbers, indicating the width and height of the image in pixels. &lt;description&gt; contains text that is included in the TITLE attribute of the link formed around the image in the HTML rendering.</p>

<p>Maximum value for width is 144, default value is 88.</p>

<p>Maximum value for height is 400, default value is 31.</p>


<h2>Requiered item's elements<a name="requiredItemElements"></a></h2>

<p>A brand may contain any number of &lt;item&gt;s. An item may represent a product or a live animal; </p>

<p>Here's a list of requiered item elements.</p>

<table cellspacing="3" cellpadding="5">
<tr valign="top"><th width="100px">Element</tdh><th width="300px">Description</th><th width="200px">Example</th></tr>
<tr valign="top">
  <td><span class="element">gtin</span></td>
  <td>The GTIN composed of 13 digits and officially assigned by the GS1 organization. GTIN-12 must be left padded with a zero. The code can be tested for validity with the <a href="http://www.gs1.org/barcodes/support/check_digit_calculator" target="_blank">GS1 check digit calculator</a>.</td>
  <td class="examplecell">3272036004636</td></tr>
<tr valign="top"><td><span class="element">name</span></td>
<td>The commercialization name of the item.</td>
<td class="examplecell">Pure orange juice extra</td></tr>
<tr valign="top"><td><span class="element">brand</span></td><td>The URL of the item.</td>
<td class="examplecell">Bio juice</td></tr>
<tr valign="top">
  <td>gpc</td>
  <td>The GPC Brick code of the item. This code is used to classify the item. GS1 Website provides the <a href="http://www.gs1.org/gsmp/kc/gpc" target="_blank">list of all the possible GPC Brick codes</a>.</td><td class="examplecell">10000201</td></tr>
</table>

<h2>Optional  item's elements<a name="requiredItemElements"></a></h2>

<p>Here's a list of optional item elements.</p>

<table cellspacing="3" cellpadding="5">
<tr valign="top"><th width="100px">Element</tdh><th width="300px">Description</th><th width="200px">Example</th></tr>
<tr valign="top">
  <td>productLine</td>
  <td>The product line of the product. Note that this element is clearly linked to the business of the manufacturer, his structure and history.</td>
  <td class="examplecell">Skin Care in cosmetic</td></tr>
<tr valign="top">
  <td>measure</td>
  <td>Specifies the measures of weight, volume and alcohol. More info here.</td><td class="examplecell">&nbsp;</td></tr>
<tr valign="top">
  <td>packaging</td>
  <td>Specifies the attributes of the packaging. More info here.</td>
  <td class="examplecell">&nbsp;</td>
</tr>
<tr valign="top">
  <td><span class="element">image</span></td>
  <td>Specifies a GIF, JPEG or PNG image of the item. More info <a href="pss-specification#ltimagegtSubelementOfLtitemgt">here</a>.</td>
  <td class="examplecell">&nbsp;</td>
</tr>
<tr valign="top">
  <td><span class="element">description</span></td>
  <td>Presentation the item. This text can be subjective.</td>
  <td class="examplecell">The best orange juice...</td>
</tr>
<tr valign="top">
  <td><span class="element">link</span></td>
  <td>URL of a  item page on the manufacturer's website.</td><td></td></tr>
<tr valign="top">
  <td>ref</td>
  <td>Reference used by the manufacturer to identify a product before its commercialization. </td>
  <td>AX23568B</td>
</tr>
<tr valign="top">
  <td><span class="element">commDate</span></td>
  <td>Indicates when the item was commercialized. <a href="pss-specification#ltpubdategtSubelementOfLtitemgt">More</a>.</td><td></td></tr>
</table>

<h3>&lt;image&gt; sub-element of &lt;item&gt;<a name="ltimagegtSubelementOfLtitemgt"></a></h3>

<p>&lt;image&gt; is an optional sub-element of &lt;item&gt;, which contains three required and three optional sub-elements.</p>

<p>&lt;url&gt; is the URL of a GIF, JPEG or PNG image of the item.</p>

<p>&lt;title&gt; describes the image, it's used in the ALT attribute of the HTML &lt;img&gt; tag when the manufacturer is rendered in HTML.</p>

<p>&lt;link&gt; is the URL of the site, when the feed is rendered, the image is a link to the site. (Note, in practice the image &lt;title&gt; and &lt;link&gt; should have the same value as the item's &lt;title&gt; and &lt;link&gt;.</p>

<p>Optional elements include &lt;width&gt; and &lt;height&gt;, numbers, indicating the width and height of the image in pixels. &lt;description&gt; contains text that is included in the TITLE attribute of the link formed around the image in the HTML rendering.</p>

<p>Maximum value for width is 144, default value is 88.</p>

<p>Maximum value for height is 400, default value is 31.</p>

<h3>&lt;measure&gt; sub-element of &lt;item&gt;<a name="ltenclosuregtSubelementOfLtitemgt"></a></h3>

<p>&lt;measure&gt; is an optional sub-element of &lt;item&gt;, which contains six optional sub-elements. Note that the volume and the weight measure may be indicated for certain type of product.</p>
<p>&lt;ml&gt; -- The volume of the item in milliliters (ml).</p>
<p>&lt;floz&gt; -- The volume of the item in fluid ounces (fl oz).</p>
<p>&lt;g&gt; -- The weight of the item in grams (g).</p>
<p>&lt;g&gt; -- The weight of the item in ounces (oz).</p>
<p>&lt;abv&gt; -- The  alcohol by volume (ABV). The degree (°) and percentage (%) have the same meaning.</p>
<p>&lt;abw&gt; -- The alcohol by weight (ABW), used by some brewers instead of ABV. The degree (°) and percentage (%) have the same meaning.</p>

<h3>&lt;packaging&gt; sub-element of &lt;item&gt;<a name="ltenclosuregtSubelementOfLtitemgt"></a></h3>

<p>&lt;packaging&gt; is an optional sub-element of &lt;item&gt;, which contains two optional sub-elements. </p>
<p>&lt;description&gt; -- Indicate the type of material used to do the pack and the shape (ex: glass bottle).</p>
<p>&lt;internalUnit&gt; -- The number of identical elements contained into a product (ex: pack of 4 pots of yogurt).</p>
<h3>&lt;commDate&gt; sub-element of &lt;item&gt;<a name="ltpubdategtSubelementOfLtitemgt"></a></h3>

<p>&lt;commDate&gt; is an optional sub-element of &lt;item&gt;.</p>

<p>Its value is a <a href="http://asg.web.cmu.edu/rfc/rfc822.html" target="_blank">date</a>, indicating when the item was commercialized. If it's a date in the future, aggregators may choose to not display the item until that date.</p>
<h2>Comments<a name="comments"></a></h2>

<p>If you have questions about the PSS format, please post them on the <a href="https://groups.google.com/forum/?hl=fr&fromgroups#!forum/pss-public" target="_blank">PSS Public group</a> . The group serves as a support resource for users, authors and developers who are creating and using content in the format.</p>
<h2>Extending PSS<a name="extendingPss"></a></h2>

<p>PSS is an adaptation of the RSS feeds, the main key used for aggregation is the product GTIN code instead of the date for the News contained in RSS.</p>
<p>RSS originated in 1999, and has strived to be a simple, easy to understand format, with relatively modest goals. After it became a popular format, developers wanted to extend it using modules defined in namespaces, as <a href="http://www.w3.org/TR/REC-xml-names/" target="_blank">specified</a> by the W3C.</p>

<p>RSS 2.0 adds that capability, following a simple rule. A RSS feed may contain elements and attributes not described on this page, only if those elements and attributes are defined in a namespace.</p>

<p>The elements defined in this document are not themselves members of a namespace, so that RSS 2.0 can remain compatible with previous versions in the following sense -- a version 0.91 or 0.92 file is also a valid 2.0 file. If the elements of RSS 2.0 were in a namespace, this constraint would break, a version 0.9x file <i>would not</i> be a valid 2.0 file.</p>

<h2>Roadmap<a name="roadmap"></a></h2>

<p>The first version of PSS is clearly focused on the food &amp; beverage products so it will probably updated to fit with characterisitcs to other kind of products. Some elements are currently not refering to codification (brand, type of packaging,...), the addition of standard codification is important.</p>
<h2>License and authorship<a name="licenseAndAuthorship"></a></h2>
<img src="http://www.product-open-data.com/images/creativecommons.png" style="float:right;" hspace="15px"  />
<p>This document is authored by the Philippe Plagnol and is offered under the terms of the Creative Commons <a href="http://creativecommons.org/licenses/by-sa/2.0/" rel="nofollow" target="_blank">Attribution/Share Alike</a> license, based on an original RSS specification published by the <a href="http://cyber.law.harvard.edu/rss/rss.html" target="_blank">Berkman Center for Internet &amp; Society at Harvard Law School authored by Dave Winer</a>.</p>