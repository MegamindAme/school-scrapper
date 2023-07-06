# school-scrapper

A package to scrape Tanzania schools

## Usage

Add the package from the composer by running <code>composer require megamindame/school_scraper
</code>

If you want to get school data by using this package, not use it in your code, you can uncomment the code section
you want in the App.php file,

## Using the Package

3 types of data can be accessed from 3 education levels. Education levels 1) Primary 2) Secondary 3)Advanced Secondary

### Data that can be accessed

1) schools - An array of formatted school data
2) nodes - XPath nodelist of all the html link tags. You can iterate through the list to scrape the results page of a
   school. Check the Xpath documentation to see how you can use the Xpath node.
3) data - An array of un-formatted school data

### Accessing the data

You can initialize any of the fetchers and pass the year you want to fetch. Images are embedded to show the returned data format.

#### 1) Primary

    $fetcher = new PrimaryFetcher(2022);

    //Get Primary schools
    return $fetcher->getSchools();
![image](https://github.com/MegamindAme/school-scrapper/assets/71287850/f90a7cee-9cb8-45f6-9430-e7a63f87438c)

    //Get Data
    return $fetcher->getPrimaryData();
![image](https://github.com/MegamindAme/school-scrapper/assets/71287850/b805f4ec-c710-4fe0-9f7a-63760ad2e6a1)

    //Get Nodes
    return $fetcher->getNodes();

#### 2) Secondary and Advanced Secondary

    $fetcher = new SecondaryFetcher(2022);
    //or
    $fetcher = new AdvancedSecondaryFetcher(2022);

    //Get Primary schools
    return $fetcher->getSchools();
![image](https://github.com/MegamindAme/school-scrapper/assets/71287850/d0ed791c-4dc7-46a6-89ce-1498cc664c05)

    //Get Data
    return $fetcher->getData();
![image](https://github.com/MegamindAme/school-scrapper/assets/71287850/01f94981-bafa-4ff4-b247-d5d84fda416d)

    //Get Nodes
    return $fetcher->getNodes();

People who want to fetch results from the nodes can use the Fetcher->getRootUrl() method to get the Root Url.
You can take a look at the code to see how the nodes can be used to fetch their corresponding web pages, in this case,
school results pages

As stated above, if you want to use the package as a standalone, then you can just download the code, run <code> composer install </code> then check the
'App.php' file for some directions on how to fetch data. Try to uncomment the sections inside the file, then run
<code>php index.php</code>. You can try to run <code>php index.php > filename</code> to save the echoed data into a
file.
