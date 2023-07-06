# school-scrapper

A package to scrape Tanzania schools

## Usage

Add the package from composer

Run <code>composer install</code>

If you just want to get school data by using this package, not use it in your code, you can uncomment the code section
you want in the App.php file,

## Using the Package

3 types of data can be accessed from 3 education levels. Education levels 1) Primary 2) Secondary 3)Advanced Secondary

### Data that can be accessed

1) schools - An array of formatted school data
2) nodes - XPath nodelist of all the html link tag. You can iterate through the list to scrape the results page of a
   school. Check the Xpath documentation to see how you can use the Xpath node.
3) data - An array of un-formatted school data

### Accessing the data

Initialize the any of the fetcher and pass the year you want to fetch.

#### 1) Primary

    $fetcher = new PrimaryFetcher(2022);

    //Get Primary schools
    return $fetcher->getSchools();

    //Get Data
    return $fetcher->getPrimaryData();
    
    //Get Nodes
    return $fetcher->getNodes();

#### 2) Secondary and Advanced Secondary

    $fetcher = new SecondaryFetcher(2022);
    //or
    $fetcher = new AdvancedSecondaryFetcher(2022);

    //Get Primary schools
    return $fetcher->getSchools();

    //Get Data
    return $fetcher->getData();
    
    //Get Nodes
    return $fetcher->getNodes();

For people who want to fetch results from the nodes, they can use the Fetcher->getRootUrl() method to get the Root Url.
You can take a look at the code to see how the nodes can be used to fetch their corresponding webpages, in this case
school results pages

As stated above, if you want to use the package as a standalone, then you can just download the code, run composer
install then check the
'App.php' file for some directions on how to fetch data. Try to uncomment the sections inside the file, then run
<code>php index.php</code>. You can try to run <code>php index.php > filename</code> to save the echoed data into a
file.