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
    stacks: {
        edges: {
            node: IStack
        }[]
    }
    clients: {
        edges: {
            node: IClient
        }[]
    }
    services: {
        edges: {
            node: IService
        }[]
    }
    projects: {
        edges: {
           node: IProject
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

export interface IClient {
    name: string,
    homepage: string,
    contentUrl: string,
    cssClass?: string[],
}

export interface IProfileImage {
    path: string,
}

export interface IStack {
    title: string,
    url: string,
    contentUrl: string
}

export interface IService {
    id: number,
    title: string,
    shortText: string,
    contentUrl: string,
    priority: number,
}

export interface IProject {
    _id: number,
    id: string,
    title: string
    description: string,
    keys: string[],
    createdAt: Date,
    category: {
        edges: {
            node: ICategory
        }[]
    }
    contentUrl: string,
}

export interface ICategory {
    title: string,
}


import gql from 'graphql-tag';

export const Models = gql`
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
        services{
            edges{
                node{
                    id
                    title
                    shortText
                    contentUrl
                    priority
                }
            }
        }
    }
`;
