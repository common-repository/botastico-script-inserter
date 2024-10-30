// Function to insert script into the head with the stored ID.
function insertScriptWithId(appId) {
  window.botasticoAppSettings = {
    appId: appId,
  };

  var script = document.createElement("script");
  script.src = "https://chatapps.botasti.co/main.js";
  script.async = true;

  document.head.appendChild(script);
}

// Retrieve the stored ID from Webflow CMS or custom storage (e.g using Webflow's CMS API).
function getStoredId() {
  // Fetch the stored ID from Webflow CMS.
  // Replace this with your own logic to retrieve the stored ID.
  // This might involve fetching data from a Webflow collection or other storage mechanisms.

  // For example, if using the Webflow CMS API:
  webflowCMS
    .items({ collectionId: "YOUR_COLLECTION_ID" })
    .then((response) => {
      const storedId = response.items[0].fields.appId; // Assuming the field name is 'appId'
      insertScriptWithId(storedId);
    })
    .catch((error) => {
      console.error("Error fetching stored ID:", error);
    });
}

// Perform actions when the Webflow editor is ready
webflow.ready().then(() => {
  // Call the function to fetch and insert the script with the stored ID
  getStoredId();
});
