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
    testimonials: {
        edges: {
            node: ITestimonial
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
    _id: number,
    id: string,
    pageTitle: string,
    title: string,
    shortText: string,
    contentUrl: string,
    priority: number,
    serviceSections: {
        edges: {
            node: IServiceSection
        }[]
    }
}

export interface TService {
    service: IService
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
    client: IClient
    contentUrl: string,
}

export interface ICategory {
    title: string,
}

export interface IServiceSection {
    id: string,
    title: string,
    description: string,
    keys: string[],
    contentUrl: string,
}

export interface ITestimonial{
    text: string,
    client: string,
    function: string,
}

export interface TProject{
    project: IProject;
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
                    _id
                    id
                    title
                    shortText
                    contentUrl
                    priority
                }
            }
        }
        testimonials{
            edges{
                node{
                    text
                    function
                    client
                }
            }
        }
    }
`;


export const ServiceModel = gql`
    query Service($id: ID!)
    {
        service(id: $id){
            pageTitle
            _id
            id
            title
            shortText
            contentUrl
            priority
            serviceSections{
                edges{
                    node{
                        title
                        description
                        contentUrl
                        keys
                    }
                }
            }
        }
    }
`;

export const ProjectModel = gql `
    query Project($id: ID!)
    {
        project(id: $id){
            id
            _id
            title
            description
            category{
                edges{
                    node{
                        title
                    }
                }
            }
            client{
                name
                homepage
            }
            contentUrl
        }
    }
`;

