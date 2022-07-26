# baokao search algorithm

A work in progress.

Currently, this is the best flow I have:

    search repos (STO) --> search folders recursively (STO) --> recall each file ID matching query (RCL) 

The main challenge with using the Drive API to implement a recursive search algorithm (because that's the only option given Drive API only goes down one layer in the folder hierarchy) is rate-limiting. It's easy enough to file recursive requests (conditional depending on file or folder) until you hit a 403 Rate Limit Exceeded error.

I calculated around 1300 requests on performing a global recursive search which 403'd many times throughout the network stack, to the point it hung Firefox.

Recursion isn't ideal for rate limiting. Perhaps we could just grab every file, and instead of relying on API for matching, do this clientside, but even then, the number of requests are huge given the scale of baokao's database, and its potential to grow in the future. 

A stopgap solution could be only to allow search on repositories. But something like 3P would still have many folders and files.

If Google Drive implemented serverside hierarchial digging, that would be pretty nice.

Until then, search isn't really necessary. I should probably go back to studying for Trials.