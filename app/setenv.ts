const {writeFile} = require('fs');
const {argv} = require('yargs');
// read environment variables from .env file
require('dotenv').config();
// read the command line arguments passed with yargs
const environment = argv.environment;
const isProduction = environment === 'prod';
const targetPath = isProduction
    ? `./src/environments/environment.prod.ts`
    : `./src/environments/environment.ts`;
// we have access to our environment variables
// in the process.env object thanks to dotenv
const prodEnvironmentFileContent = `
export const environment = {
    production: ${isProduction},
    apiUrl: "${process.env.API_ENDPOINT}",
    graphqlEndpoint: "${process.env.GRAPHQL_ENDPOINT}",
};
`;

const devEnvironmentFileContent = `
export const environment = {
    production: ${isProduction},
    apiUrl: "${process.env.DEV_API_ENDPOINT}",
    graphqlEndpoint: "${process.env.DEV_GRAPHQL_ENDPOINT}",
};
`;

let environmentFileContent = ``;

if (isProduction){
    environmentFileContent = prodEnvironmentFileContent;
}else{
    environmentFileContent = devEnvironmentFileContent;
}
// write the content to the respective file
writeFile(targetPath, environmentFileContent, function (err) {
    if (err) {
        console.log(err);
    }
    console.log(`Wrote variables to ${targetPath}`);
});
