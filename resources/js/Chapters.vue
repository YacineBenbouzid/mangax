<template>
    <div>
      <h1>Fetched Chapter URLs</h1>
      <ul>
        <li >text</li>
      </ul>
    </div>
  </template>
  
  <script setup> 

  import puppeteer from 'puppeteer-core';
  // Or import puppeteer from 'puppeteer-core';
  

  async function fetchChapterUrl(url) {
    const browser = await puppeteer.launch({ headless: true });
    const page = await browser.newPage();
    await page.goto(url, { waitUntil: 'networkidle2' });

    // Click on the first clickable element within the specified div
    try {
        const clickableElement = await page.$$('#wr_series_chapter .flex.cursor-pointer');
        console.log(clickableElement.length)
        for(i=0;i<clickableElement.length;i++){
            await page.goto(url, { waitUntil: 'networkidle2' });
            const clickableElements = await page.$$('#wr_series_chapter .flex.cursor-pointer');

            await clickableElements[i].click(); // Click the element
            await page.waitForNavigation({ waitUntil: 'networkidle2' }); // Wait for navigation

            const currentUrl = page.url(); // Get the current URL
            console.log("Chapter URL:", currentUrl);
            /*await page.goBack({ waitUntil: 'domcontentloaded' });
            console.log("Chapter URL:", currentUrl); // Print the URL*/
        }
            

    } catch (error) {
        console.error("Error during clicking or navigation:", error);
    }

    await browser.close();
}

const url = 'https://www.voyce.me/series/a-day-in-the-life-of-a-strange-couple';
fetchChapterUrl(url);
  </script>
  
  <style scoped>
  /* Add any specific styling if needed */
  </style>
  