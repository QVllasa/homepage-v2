import gql from "graphql-tag";


export interface IMainPage {
    banners: {
        edges: {
            node: IBanner
        }[]
    }
    aboutMe: IAboutMe
    profileImages: {
        edges: {
            node: IProfileImage
        }[]
    }
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
    url: string;
    description: string;
}

export interface IClient {
    name: string,
    url: string,
    contentUrl: string,
    cssClass?: string[],
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
    finishedAt: Date,
    keys: string[],
    createdAt: Date,
    category: {
        edges: {
            node: ICategory
        }[]
    }
    client: IClient
    contentUrl: string,
    previewUrl: string,
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

export interface ITestimonial {
    text: string,
    client: string,
    function: string,
}

export interface TProject {
    project: IProject;
}

export interface IProfileImage {
    id: string;
    filename: string;
    mimeType: string,
    contentUrl: string;
}

export interface IBanner {
    id: string,
    filename: string,
    priority: number,
    contentUrl: string,
    mimeType: string,
}




export const Models = gql`
    {
        banners{
            edges{
                node{
                    title
                    filename
                    priority
                    contentUrl
                    mimeType
                }
            }
        }
        aboutMe(id: "/about_mes/1"){
            text
            quote
        }
        profileImages{
            edges{
                node{
                    id
                    filename
                    contentUrl
                    mimeType
                }
            }
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
                    url
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
                    previewUrl
                }
            }
        }
        clients{
            edges{
                node{
                    name
                    url
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

export const ProjectModel = gql`
    query Project($id: ID!)
    {
        project(id: $id){
            id
            _id
            title
            description
            finishedAt
            keys
            category{
                edges{
                    node{
                        title
                    }
                }
            }
            client{
                name
                url
            }
            contentUrl
        }
    }
`;

