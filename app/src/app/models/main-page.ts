export interface IMainPage {
    aboutMe: IAboutMe
    skills: {
        edges: {
            node: ISkill
        }[]
    }
    experiences: {
        edges: {
            node: IExperience
        }[]
    }
}

export interface IAboutMe {
    quote: string;
    text: string;
}

export interface ISkill {
    title: string;
    value: number;
}

export interface IExperience {
    date: string;
    function: string;
    company: string;
    companyUrl: string;
    description: string;
}


import gql from 'graphql-tag';

export const MainPage = gql`
    {
        aboutMe(id: "/about_mes/1"){
            text
            quote
        }
        skills{
            edges{
                node{
                    title
                    value
                }
            }
        }
        experiences{
            edges{
                node{
                    date
                    function
                    company
                    companyUrl
                    description
                }
            }
        }
        stacks{
            edges{
                node{
                    title
                    url
                    contentUrl
                }
            }
        }
        projects{
            edges{
                node{
                    _id
                    id
                    title
                    description
                    keys
                    createdAt
                    category{
                        edges{
                            node{
                                title
                            }
                        }
                    }
                    client{
                        name
                    }
                    contentUrl
                }
            }
        }
        clients{
            edges{
                node{
                    name
                    homepage
                    contentUrl
                    cssClass
                }
            }
        }
    }
`;
